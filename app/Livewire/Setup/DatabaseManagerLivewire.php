<?php

namespace App\Livewire\Setup;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DatabaseManagerLivewire extends Component
{
    use LivewireAlert;

    public array $backups = [];
    public string $customDbPath = '';
    public string $currentDbPath = '';
    public bool $isConnected = true;
    protected const BACKUP_DIR = 'ims/backup';

    public function mount()
    {
        $this->loadBackups();
        try {
            $this->currentDbPath = $this->getDatabasePath();
        } catch (\Throwable $e) {
            $this->currentDbPath = 'Unknown';
        }
    }

    // -------------------------
    // Safe DB Disconnect / Connect
    // -------------------------
    public function dc()
    {
        $this->disconnectDatabase();
        $this->isConnected = false;
        $this->alert('success', 'Database disconnected safely.');
    }

    public function rc()
    {
        $this->connectDatabase();
        $this->isConnected = true;
        $this->alert('success', 'Database connected safely.');
    }

    public function connectCustomDatabase()
    {
        $this->validate([
            'customDbPath' => 'required|string'
        ]);

        $path = trim($this->customDbPath);

        if (!file_exists($path)) {
            $this->alert('error', 'The database file does not exist at the specified path.');
            return;
        }

        try {
            $this->disconnectDatabase();

            // Update .env file
            $this->updateEnvDatabasePath($path);

            // Reconfigure run-time config
            config(['database.connections.sqlite.database' => $path]);

            $this->connectDatabase();
            $this->currentDbPath = $path;
            $this->isConnected = true;
            $this->customDbPath = '';
            $this->alert('success', 'Connected to the selected database successfully.');
        } catch (\Throwable $e) {
            $this->alert('error', 'Connection failed: ' . $e->getMessage());
        }
    }

    protected function updateEnvDatabasePath(string $newPath)
    {
        $envPath = base_path('.env');
        if (file_exists($envPath)) {
            $content = file_get_contents($envPath);
            if (preg_match('/^DB_DATABASE=/m', $content)) {
                $content = preg_replace('/^DB_DATABASE=.*$/m', "DB_DATABASE=" . $newPath, $content);
            } else {
                $content .= "\nDB_DATABASE=" . $newPath;
            }
            file_put_contents($envPath, $content);
        }
    }

    protected function disconnectDatabase()
    {
        try {
            // Flush WAL changes to main DB first
            $this->checkpointWal();

            // Switch to safe journal mode
            DB::statement('PRAGMA journal_mode=DELETE;');

            DB::disconnect('sqlite');
        } catch (\Throwable $e) {
            Log::warning('Failed to disconnect SQLite: ' . $e->getMessage());
        }
    }

    protected function connectDatabase()
    {
        try {
            DB::reconnect('sqlite');

            // Optional: re-enable WAL mode for performance and concurrency
            DB::statement('PRAGMA journal_mode=WAL;');
        } catch (\Throwable $e) {
            Log::warning('Failed to reconnect SQLite: ' . $e->getMessage());
        }
    }

    protected function checkpointWal()
    {
        try {
            DB::statement('PRAGMA wal_checkpoint(FULL);');
        } catch (\Throwable $e) {
            // Ignore if WAL not active
        }
    }

    // -------------------------
    // Get Active SQLite Path
    // -------------------------
    protected function getDatabasePath(): string
    {
        try {
            $pdo = DB::connection('sqlite')->getPdo();
            $stmt = $pdo->query('PRAGMA database_list;');
            $databases = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($databases as $db) {
                if ($db['name'] === 'main' && !empty($db['file'])) {
                    return $db['file'];
                }
            }
        } catch (\Throwable $e) {
            Log::error('Failed to get SQLite path: ' . $e->getMessage());
        }

        throw new \Exception('Unable to determine active SQLite database file.');
    }

    // -------------------------
    // Backup Database Safely
    // -------------------------
    public function backupDatabase()
    {
        try {
            $this->disconnectDatabase(); // Ensure no connections during backup
            $sourcePath = $this->getDatabasePath();

            if (!file_exists($sourcePath) || filesize($sourcePath) === 0) {
                $this->alert('error', 'Database file is missing or empty.');
                return;
            }

            // Backup with timestamp
            $timestamp = Carbon::now()->format('Y-m-d_His');
            $fileName = "ims_backup_{$timestamp}.sqlite";

            // Copy database safely
            copy($sourcePath, Storage::disk('documents')->path(self::BACKUP_DIR . '/' . $fileName));

            $this->alert('success', "Backup created successfully: {$fileName}");
            $this->loadBackups();

        } catch (\Throwable $e) {
            Log::error('Backup failed: ' . $e->getMessage());
            $this->alert('error', 'Backup failed: ' . $e->getMessage());
        } finally {
            $this->connectDatabase(); // Reconnect after backup
        }
    }

    // -------------------------
    // Recover Database Safely
    // -------------------------
    public function recoverDatabase(string $backupPath)
    {
        try {
            $this->disconnectDatabase(); // Ensure no active connection

            $destinationPath = $this->getDatabasePath();
            $backupFullPath = Storage::disk('documents')->path($backupPath);

            if (!file_exists($backupFullPath)) {
                $this->alert('error', 'Backup file not found.');
                return;
            }

            // Create temporary copy to prevent partial write corruption
            $tempPath = $destinationPath . '.tmp';
            copy($backupFullPath, $tempPath);

            // Atomically replace original database
            rename($tempPath, $destinationPath);

            $this->alert('success', 'Database restored successfully. Restart recommended.');
            $this->loadBackups();

        } catch (\Throwable $e) {
            Log::error('Recovery failed: ' . $e->getMessage());
            $this->alert('error', 'Recovery failed: ' . $e->getMessage());
        } finally {
            $this->connectDatabase();
        }
    }

    // -------------------------
    // Delete Backup
    // -------------------------
    public function deleteBackup(string $backupPath)
    {
        try {
            if (Storage::disk('documents')->delete($backupPath)) {
                $this->alert('success', 'Backup deleted successfully.');
                $this->loadBackups();
            } else {
                $this->alert('error', 'Failed to delete backup.');
            }
        } catch (\Throwable $e) {
            Log::error('Delete failed: ' . $e->getMessage());
            $this->alert('error', 'Delete failed: ' . $e->getMessage());
        }
    }

    // -------------------------
    // Load Backups
    // -------------------------
    public function loadBackups()
    {
        if (!Storage::disk('documents')->exists(self::BACKUP_DIR)) {
            $this->backups = [];
            return;
        }

        $files = Storage::disk('documents')->files(self::BACKUP_DIR);

        $this->backups = collect($files)
            ->filter(fn($f) => str_ends_with($f, '.sqlite'))
            ->map(function ($file) {
                $name = basename($file);
                $timestamp = str_replace(['ims_backup_', '.sqlite'], '', $name);
                try {
                    $date = Carbon::createFromFormat('Y-m-d_His', $timestamp)
                        ->format('Y-m-d H:i:s');
                } catch (\Exception $e) {
                    $date = 'Unknown';
                }

                return [
                    'path' => $file,
                    'name' => $name,
                    'date' => $date,
                ];
            })
            ->sortByDesc('name')
            ->values()
            ->all();
    }

    public function render()
    {
        return view('livewire.setup.database-manager-livewire')->layout('layouts.blank');
    }
}

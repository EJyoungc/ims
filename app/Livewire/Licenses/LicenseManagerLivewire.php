<?php

namespace App\Livewire\Licenses;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Machine;
use App\Models\License;
use App\Services\LicenseVerifier;
use App\Services\LicenseInfo;

class LicenseManagerLivewire extends Component
{
    use LivewireAlert;

    public string $machineId;
    public string $licenseKey = '';
    public string $status = 'none';
    public ?int $daysRemaining = null;

    public function mount()
    {
        $this->machineId = Machine::id();
        // dd($this->machineId);

        // 🔍 DEBUG (safe to remove later)
        logger()->info('LICENSE DEBUG', [
            'disk' => config('filesystems.default'),
            'license_exists' => Storage::disk('local')->exists('license.dat'),
            'machine_id' => $this->machineId,
        ]);

        /**
         * 1️⃣ PAID LICENSE CHECK (AUTO-HEALING)
         */
        if (Storage::disk('local')->exists('license.dat')) {
            try {
                $licenseKey = decrypt(Storage::disk('local')->get('license.dat'));

                if (LicenseVerifier::verify($licenseKey)) {
                    $this->status = 'active';
                    $this->daysRemaining = LicenseInfo::daysRemaining();
                    return;
                }

                // ❌ Invalid file → delete it (AUTO-RESET)
                Storage::disk('local')->delete('license.dat');
            } catch (\Throwable $e) {
                // Corrupt file → delete
                Storage::disk('local')->delete('license.dat');
            }
        }

        /**
         * 2️⃣ TRIAL CHECK (DATABASE)
         */
        $license = License::where('machine_id', $this->machineId)->first();

        if (! $license || ! $license->trial_started_at) {
            $this->status = 'none';
            return;
        }

        // 🚫 Trial revoked and not restored
        if ($license->trial_revoked_at && ! $license->trial_restored_at) {
            $this->status = 'tampered';
            return;
        }

        $trialDays = config('app.trial_days', 14);
        $daysUsed  = now()->diffInDays($license->trial_started_at);

        if ($daysUsed < $trialDays) {
            $this->status = 'trial';
            $this->daysRemaining = $trialDays - $daysUsed;
            return;
        }

        $this->status = 'expired';
    }

    /**
     * ▶️ START TRIAL
     */
    public function startTrial()
    {
        $license = License::firstOrCreate([
            'machine_id' => $this->machineId,
        ]);

        if ($license->trial_revoked_at && ! $license->trial_restored_at) {
            $this->alert('error', 'Trial permanently disabled on this machine');
            return;
        }

        if ($license->trial_started_at) {
            $this->alert('warning', 'Trial already started');
            return;
        }

        $license->update([
            'trial_started_at' => now(),
        ]);

        $this->alert('success', 'Trial started successfully');
        $this->mount();
    }

    /**
     * 🔑 ACTIVATE PAID LICENSE
     */
    public function activate()
    {
        if (! LicenseVerifier::verify($this->licenseKey)) {
            $this->alert('error', 'Invalid license key');
            return;
        }

        Storage::disk('local')->put(
            'license.dat',
            encrypt($this->licenseKey)
        );

        $this->alert('success', 'License activated successfully');
        $this->mount();
    }

    /**
     * 🔄 HARD RESET (ADMIN / DEV ONLY)
     */
    public function resetAll()
    {
        // delete license file
        Storage::disk('local')->delete('license.dat');

        // reset DB state
        License::where('machine_id', $this->machineId)->delete();

        $this->status = 'none';
        $this->daysRemaining = null;

        $this->alert('success', 'System fully reset');
        $this->mount();
    }

    public function render()
    {
        
        return view('livewire.licenses.license-manager-livewire')
            ->layout('layouts.blank');
    }
}

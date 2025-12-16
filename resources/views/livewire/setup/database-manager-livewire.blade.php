<div class="min-vh-100 w-100 d-flex align-items-center justify-content-center">
    <div class="container mt-4">

        

        {{-- Backup / Connect / Disconnect Buttons --}}
        <div class="mb-4">
            <div class="btn-group">
                <button wire:click="backupDatabase" class="btn btn-success">
                    Backup Database
                    <x-spinner for="backupDatabase" />
                </button>
                <button wire:click="rc" class="btn btn-success">
                    Connect Database
                    <x-spinner for="rc" />
                </button>
                <button wire:click="dc" class="btn btn-success">
                    Disconnect Database
                    <x-spinner for="dc" />
                </button>
            </div>
        </div>

        {{-- Backups List --}}
        <div class="card w-100">
            <div class="card-header">
                <strong>Available Backups</strong>
            </div>

            <div class="card-body p-0">
                @if (empty($backups))
                    <div class="p-3 text-muted">
                        No backups found.
                    </div>
                @else
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>File</th>
                                <th>Date</th>
                                <th style="width: 220px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($backups as $backup)
                                <tr>
                                    <td>{{ $backup['name'] }}</td>
                                    <td>{{ $backup['date'] }}</td>
                                    <td>
                                        <button wire:click="recoverDatabase('{{ $backup['path'] }}')"
                                            class="btn btn-sm btn-primary"
                                            onclick="return confirm('Restore this backup? This will overwrite the current database.')">
                                            Restore
                                        </button>

                                        <button wire:click="deleteBackup('{{ $backup['path'] }}')"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this backup?')">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

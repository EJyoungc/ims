<div class="container mt-5">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-glow-1: #1e1b4b;
            --bg-glow-2: #311042;
            --card-bg: rgba(15, 23, 42, 0.45);
            --border-color: rgba(255, 255, 255, 0.08);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --accent-primary: #6366f1;
            --accent-hover: #4f46e5;
            --accent-glow: rgba(99, 102, 241, 0.35);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at 10% 20%, var(--bg-glow-2) 0%, #030712 90%);
            min-height: 100vh;
            color: var(--text-primary);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .db-wrapper {
            position: relative;
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1.5rem;
            z-index: 10;
        }

        /* Ambient Lights */
        .ambient-light {
            position: absolute;
            width: 45vw;
            height: 45vw;
            border-radius: 50%;
            filter: blur(140px);
            opacity: 0.15;
            pointer-events: none;
            z-index: 1;
            animation: floatGlow 18s infinite alternate ease-in-out;
        }

        .ambient-light-1 {
            top: -10%;
            left: 5%;
            background: #6366f1;
        }

        .ambient-light-2 {
            bottom: -10%;
            right: 5%;
            background: #d946ef;
            animation-delay: -6s;
        }

        /* Glassmorphic Cards */
        .db-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 900px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            z-index: 5;
            transition: all 0.3s ease;
        }

        /* Header */
        .brand-header-db {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-logo-img {
            max-height: 70px;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 12px rgba(255,255,255,0.1));
        }

        .db-title {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 30%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
        }

        .db-subtitle {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
        }

        /* Connection Info Section */
        .conn-info-section {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .conn-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .conn-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            width: fit-content;
        }

        .badge-connected {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .badge-disconnected {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* Premium Buttons */
        .btn-db-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            border: none;
        }

        .btn-action-primary {
            background: linear-gradient(135deg, var(--accent-primary) 0%, #4f46e5 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .btn-action-primary:hover:not(:disabled) {
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
            transform: translateY(-2px);
        }

        .btn-action-secondary {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .btn-action-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .btn-action-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        .btn-action-success:hover {
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }

        .btn-action-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .btn-action-danger:hover {
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
            transform: translateY(-2px);
        }

        .btn-db-action:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        .button-group-layout {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2.5rem;
        }

        /* Custom Inputs */
        .input-group-custom {
            margin-bottom: 1.5rem;
        }

        .input-group-custom label {
            display: block;
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 0.6rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .input-control-custom {
            width: 100%;
            padding: 14px 16px 14px 48px;
            background: rgba(15, 23, 42, 0.6);
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 1rem;
            font-family: inherit;
            outline: none;
            box-sizing: border-box;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-control-custom:focus {
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 4px var(--accent-glow);
            background: rgba(15, 23, 42, 0.8);
        }

        .input-control-custom:focus + i {
            color: var(--accent-primary);
        }

        .text-danger {
            color: #f87171;
            font-size: 0.8rem;
            margin-top: 0.4rem;
            display: block;
        }

        /* Glassmorphic Table */
        .table-card {
            background: rgba(15, 23, 42, 0.3);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            margin-top: 2rem;
        }

        .table-card-title {
            padding: 1.2rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 700;
            color: #a5b4fc;
            border-bottom: 1px solid var(--border-color);
            background: rgba(255,255,255,0.02);
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        .table-custom th, .table-custom td {
            padding: 1rem 1.5rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table-custom th {
            background: rgba(255,255,255,0.01);
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .table-custom tr:last-child td {
            border-bottom: none;
        }

        .table-custom tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }

        .text-muted-custom {
            color: var(--text-secondary);
            padding: 2rem;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .btn-db-action {
                width: 100%;
            }
        }
    </style>

    <div class="ambient-light ambient-light-1"></div>
    <div class="ambient-light ambient-light-2"></div>

    <div class="db-wrapper">
        <div class="db-card">
            <div class="brand-header-db">
                <img src="{{ asset('dist/img/IMS logo 128 x128.png') }}" class="brand-logo-img" alt="IMS Logo">
                <h1 class="db-title">Database Manager</h1>
                <p class="db-subtitle">Maintain, backup, restore and switch SQLite databases</p>
            </div>

            {{-- Connection Info --}}
            <div class="conn-info-section">
                <div class="conn-details">
                    <span style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.5px;">Active Database Path</span>
                    <span style="font-family: monospace; font-size: 0.95rem; word-break: break-all;">{{ $currentDbPath }}</span>
                </div>
                <div>
                    @if ($isConnected)
                        <div class="conn-status-badge badge-connected">
                            <i class="fa-solid fa-circle-nodes"></i> Connected
                        </div>
                    @else
                        <div class="conn-status-badge badge-disconnected">
                            <i class="fa-solid fa-power-off"></i> Disconnected
                        </div>
                    @endif
                </div>
            </div>

            {{-- Actions Panel --}}
            <div class="button-group-layout">
                <button wire:click="backupDatabase" class="btn-db-action btn-action-success" :disabled="!$isConnected">
                    <i class="fa-solid fa-cloud-arrow-down"></i> Create Backup
                    <x-spinner for="backupDatabase" />
                </button>
                
                @if ($isConnected)
                    <button wire:click="dc" class="btn-db-action btn-action-danger">
                        <i class="fa-solid fa-link-slash"></i> Disconnect DB
                        <x-spinner for="dc" />
                    </button>
                @else
                    <button wire:click="rc" class="btn-db-action btn-action-primary">
                        <i class="fa-solid fa-link"></i> Reconnect DB
                        <x-spinner for="rc" />
                    </button>
                @endif
            </div>

            {{-- Connect to a Database of your choosing Section --}}
            <div style="background: rgba(15, 23, 42, 0.3); border: 1px solid var(--border-color); border-radius: 16px; padding: 2rem; margin-top: 2rem;">
                <h4 style="margin: 0 0 1.25rem 0; font-weight: 700; color: #a5b4fc; font-size: 1.15rem;">
                    <i class="fa-solid fa-folder-open" style="margin-right: 6px;"></i> Connect to Database of Your Choosing
                </h4>
                
                <form wire:submit.prevent="connectCustomDatabase">
                    <div class="input-group-custom">
                        <label>SQLite Database File Path</label>
                        <div class="input-wrapper">
                            <input type="text" class="input-control-custom" wire:model="customDbPath" placeholder="e.g. C:\laragon\www\ims\database\database.sqlite">
                            <i class="fa-solid fa-file-database" style="font-style: normal; font-family: 'Font Awesome 6 Free'; font-weight: 900;">&#xf1c0;</i>
                        </div>
                        @error('customDbPath')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-db-action btn-action-primary">
                        <i class="fa-solid fa-circle-chevron-right"></i> Connect to Custom Database <x-spinner for="connectCustomDatabase" />
                    </button>
                </form>
            </div>

            {{-- Backups list --}}
            <div class="table-card">
                <div class="table-card-title">
                    <i class="fa-solid fa-database" style="margin-right: 6px;"></i> Available Backups
                </div>

                @if (empty($backups))
                    <div class="text-muted-custom">
                        <i class="fa-regular fa-folder-open" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                        No backup files found. Create a new backup to get started.
                    </div>
                @else
                    <div style="overflow-x: auto;">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>Created Date</th>
                                    <th style="width: 220px; text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($backups as $backup)
                                    <tr>
                                        <td>
                                            <span style="font-weight: 500;">{{ $backup['name'] }}</span>
                                        </td>
                                        <td style="color: var(--text-secondary);">
                                            {{ $backup['date'] }}
                                        </td>
                                        <td style="text-align: right; display: flex; gap: 0.5rem; justify-content: flex-end;">
                                            <button wire:click="recoverDatabase('{{ $backup['path'] }}')"
                                                class="btn-db-action btn-action-primary" style="padding: 6px 12px; font-size: 0.85rem;"
                                                onclick="return confirm('Restore this backup? This will overwrite the current database.')" :disabled="!$isConnected">
                                                <i class="fa-solid fa-rotate-left"></i> Restore <x-spinner for="recoverDatabase('{{ $backup['path'] }}')" />
                                            </button>

                                            <button wire:click="deleteBackup('{{ $backup['path'] }}')"
                                                class="btn-db-action btn-action-danger" style="padding: 6px 12px; font-size: 0.85rem;">
                                                <i class="fa-regular fa-trash-can"></i> Delete <x-spinner for="deleteBackup('{{ $backup['path'] }}')" />
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Back to Login shortcut -->
            <div style="text-align: center; margin-top: 2.5rem; border-top: 1px solid var(--border-color); padding-top: 2rem;">
                <a href="{{ route('login') }}" class="btn-db-action btn-action-secondary">
                    <i class="fa-solid fa-arrow-left-long"></i> Back to Login
                </a>
            </div>
        </div>
    </div>
</div>

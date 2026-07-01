<div>
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

        .setup-wrapper {
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
        .setup-card {
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

        /* Brand Logo Header */
        .brand-header-setup {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-logo-img {
            max-height: 70px;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 12px rgba(255,255,255,0.1));
        }

        .setup-title {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 30%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
        }

        .setup-subtitle {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
        }

        /* Check Results Section */
        .check-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .check-card {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 180px;
        }

        .check-card:hover {
            border-color: rgba(99, 102, 241, 0.3);
            transform: translateY(-2px);
        }

        .check-card h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 0.8rem 0;
            color: var(--text-primary);
        }

        .check-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            width: fit-content;
        }

        .badge-success-custom {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .badge-danger-custom {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .check-details {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-top: 1rem;
            line-height: 1.4;
        }

        /* Action Buttons */
        .btn-setup-action {
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
            width: 100%;
            margin-top: 1rem;
        }

        .btn-action-primary {
            background: linear-gradient(135deg, var(--accent-primary) 0%, #4f46e5 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .btn-action-primary:hover {
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
        }

        .btn-action-success:hover {
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }

        /* Custom Form elements */
        .setup-form-wrapper {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
        }

        .setup-form-wrapper h4 {
            margin-bottom: 1.5rem;
            font-weight: 700;
            color: #a5b4fc;
        }

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

        /* Spinner & Loaders */
        .spinner-custom {
            border: 3px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            border-top-color: var(--accent-primary);
            width: 3.5rem;
            height: 3.5rem;
            animation: spin 1s linear infinite;
            margin: 0 auto 1.5rem auto;
        }

        .flex-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 300px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>

    <div class="ambient-light ambient-light-1"></div>
    <div class="ambient-light ambient-light-2"></div>

    <div class="setup-wrapper">
        <div class="setup-card">
            <div class="brand-header-setup">
                <img src="{{ asset('dist/img/IMS logo 128 x128.png') }}" class="brand-logo-img" alt="IMS Logo">
                <h1 class="setup-title">System Setup</h1>
                <p class="setup-subtitle">Verifying your installation requirements</p>
            </div>

            <!-- Loader / Checking -->
            <div wire:loading class="flex-center">
                <div class="spinner-custom"></div>
                <h4>Running setup checks...</h4>
                <p class="text-muted mt-2">Checking database and admin tables</p>
            </div>

            <div wire:loading.remove>
                <!-- Results cards grid -->
                <div class="check-grid">
                    
                    <!-- DB Connection Status -->
                    <div class="check-card">
                        <div>
                            <h5>Database Connection</h5>
                            @if ($dbConnected)
                                <div class="check-badge badge-success-custom">
                                    <i class="fa-solid fa-circle-check"></i> Connected
                                </div>
                                <div class="check-details">Successfully established connection with the SQLite database.</div>
                            @else
                                <div class="check-badge badge-danger-custom">
                                    <i class="fa-solid fa-circle-xmark"></i> Failed
                                </div>
                                <div class="check-details text-danger">Unable to locate or connect to the database. Check settings.</div>
                            @endif
                        </div>
                    </div>

                    <!-- Users Table Status -->
                    <div class="check-card">
                        <div>
                            <h5>Users Table</h5>
                            @if ($usersTableExists)
                                <div class="check-badge badge-success-custom">
                                    <i class="fa-solid fa-circle-check"></i> Ready
                                </div>
                                <div class="check-details">Required database migration tables exist.</div>
                            @else
                                <div class="check-badge badge-danger-custom">
                                    <i class="fa-solid fa-triangle-exclamation"></i> Not Found
                                </div>
                                <div class="check-details">Core structure missing. Run migrations to populate tables.</div>
                            @endif
                        </div>
                        @if (!$usersTableExists && $dbConnected)
                            <button wire:click="runMigrations" class="btn-setup-action btn-action-primary">
                                <i class="fa-solid fa-play"></i> Run Migrations <x-spinner for="runMigrations" />
                            </button>
                        @endif
                    </div>

                    <!-- Owner Account Status -->
                    <div class="check-card">
                        <div>
                            <h5>Owner Account</h5>
                            @if ($hasOwner)
                                <div class="check-badge badge-success-custom">
                                    <i class="fa-solid fa-circle-check"></i> Active
                                </div>
                                <div class="check-details">System owner account is configured and ready.</div>
                            @else
                                <div class="check-badge badge-danger-custom">
                                    <i class="fa-solid fa-user-xmark"></i> Missing
                                </div>
                                <div class="check-details">An owner administrator account must be created to access dashboard.</div>
                            @endif
                        </div>
                        @if (!$hasOwner && $usersTableExists)
                            <button wire:click.prevent='open' class="btn-setup-action btn-action-primary">
                                <i class="fa-solid fa-user-plus"></i> Create Owner <x-spinner for="open" />
                            </button>
                        @endif
                    </div>

                </div>

                <!-- Create Owner Form when expanded -->
                @if ($form && !$hasOwner)
                    <div class="setup-form-wrapper">
                        <h4>Create Owner Account</h4>
                        <form wire:submit.prevent='store'>
                            
                            <!-- Name -->
                            <div class="input-group-custom">
                                <label>Full Name</label>
                                <div class="input-wrapper">
                                    <input type="text" wire:model="name" class="input-control-custom" placeholder="e.g. John Doe">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="input-group-custom">
                                <label>Email Address</label>
                                <div class="input-wrapper">
                                    <input type="email" wire:model="email" class="input-control-custom" placeholder="e.g. john@example.com">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="input-group-custom">
                                <label>Password</label>
                                <div class="input-wrapper">
                                    <input type="password" wire:model="password" class="input-control-custom" placeholder="••••••••">
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                                <button type="submit" class="btn-setup-action btn-action-primary" style="margin-top:0;">
                                    <i class="fa-solid fa-check"></i> Register Account <x-spinner for="store" />
                                </button>
                                <button type="button" wire:click="cancel" class="btn-setup-action btn-action-secondary" style="margin-top:0; max-width: 150px;">
                                    Cancel
                                </button>
                            </div>

                        </form>
                    </div>
                @endif

                <!-- Bottom Re-check and login shortcuts -->
                <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center; margin-top: 3rem; border-top: 1px solid var(--border-color); padding-top: 2rem;">
                    <button wire:click="runChecks" class="btn-setup-action btn-action-secondary" style="margin-top:0; width: auto; min-width: 200px;">
                        <i class="fa-solid fa-arrows-rotate"></i> Re-run Setup Check <x-spinner for="runChecks" />
                    </button>
                    <a href="{{ route('login') }}" class="btn-setup-action btn-action-success" style="margin-top:0; width: auto; min-width: 200px;">
                        Skip to Login <i class="fa-solid fa-right-to-bracket" style="margin-left: 4px;"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

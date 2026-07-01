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

        .lic-wrapper {
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
        .lic-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 580px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            z-index: 5;
            transition: all 0.3s ease;
        }

        /* Header */
        .brand-header-lic {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-logo-img {
            max-height: 70px;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 12px rgba(255,255,255,0.1));
        }

        .lic-title {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 30%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            cursor: pointer;
        }

        .lic-subtitle {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
        }

        /* Styled Status Alert Box */
        .status-box {
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1rem;
            border: 1px solid transparent;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.2);
        }

        .status-trial {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border-color: rgba(245, 158, 11, 0.2);
        }

        .status-expired {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.2);
        }

        /* Form elements */
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

        .textarea-custom {
            width: 100%;
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 0.95rem;
            font-family: inherit;
            outline: none;
            box-sizing: border-box;
            transition: all 0.3s ease;
            resize: vertical;
        }

        .textarea-custom:focus {
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px var(--accent-glow);
            background: rgba(15, 23, 42, 0.8);
        }

        .textarea-readonly {
            background: rgba(15, 23, 42, 0.3);
            color: var(--text-secondary);
            border-color: var(--border-color);
            font-family: monospace;
            font-size: 0.85rem;
        }

        /* Buttons styling */
        .btn-lic-action {
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
            margin-bottom: 1rem;
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

        .btn-action-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
        }

        .btn-action-warning:hover {
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
            transform: translateY(-2px);
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

        .btn-action-secondary {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .btn-action-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>

    <div class="ambient-light ambient-light-1"></div>
    <div class="ambient-light ambient-light-2"></div>

    <div class="lic-wrapper">
        <div class="lic-card">
            <div class="brand-header-lic">
                <img src="{{ asset('dist/img/IMS logo 128 x128.png') }}" class="brand-logo-img" alt="IMS Logo">
                <h1 class="lic-title" wire:click="resetAll" wire:confirm.prompt="Are you sure?\n\nType RESET to confirm|RESET">
                    Software License
                </h1>
                <p class="lic-subtitle">Verify machine ID and activate copy of your installation</p>
            </div>

            {{-- STATUS ALERTS --}}
            @if ($status === 'active')
                <div class="status-box status-active">
                    <i class="fa-solid fa-circle-check" style="font-size: 1.25rem;"></i>
                    <div>
                        <strong>License Active</strong>
                        @if ($daysRemaining)
                            <div style="font-size: 0.85rem; margin-top: 0.2rem; opacity: 0.9;">Expires in {{ $daysRemaining }} days</div>
                        @endif
                    </div>
                </div>
            @elseif($status === 'trial')
                <div class="status-box status-trial">
                    <i class="fa-solid fa-flask" style="font-size: 1.25rem;"></i>
                    <div>
                        <strong>Trial Mode Active</strong>
                        <div style="font-size: 0.85rem; margin-top: 0.2rem; opacity: 0.9;">{{ $daysRemaining }} days remaining</div>
                    </div>
                </div>
            @elseif($status === 'expired')
                <div class="status-box status-expired">
                    <i class="fa-solid fa-circle-exclamation" style="font-size: 1.25rem;"></i>
                    <div>
                        <strong>Trial Expired</strong>
                        <div style="font-size: 0.85rem; margin-top: 0.2rem; opacity: 0.9;">Please purchase or activate a license key.</div>
                    </div>
                </div>
            @elseif($status === 'tampered')
                <div class="status-box status-expired">
                    <i class="fa-solid fa-ban" style="font-size: 1.25rem;"></i>
                    <div>
                        <strong>Trial Tampering Detected</strong>
                        <div style="font-size: 0.85rem; margin-top: 0.2rem; opacity: 0.9;">Trial permanently disabled. Contact support.</div>
                    </div>
                </div>
            @endif

            {{-- MACHINE ID --}}
            <div class="input-group-custom">
                <label>Machine ID</label>
                <textarea class="textarea-custom textarea-readonly" rows="2" readonly>{{ $machineId }}</textarea>
            </div>

            {{-- LICENSE INPUT (PAID) --}}
            @if (in_array($status, ['trial', 'expired', 'active', 'none']))
                <div class="input-group-custom">
                    <label>License Key</label>
                    <textarea wire:model.defer="licenseKey" class="textarea-custom" rows="4" placeholder="Paste your generated license key here..."></textarea>
                </div>

                <button wire:click="activate" class="btn-lic-action btn-action-primary">
                    <i class="fa-solid fa-key"></i> Activate License <x-spinner for="activate" />
                </button>
            @endif

            {{-- START TRIAL BUTTON --}}
            @if ($status === 'none')
                <button wire:click="startTrial" class="btn-lic-action btn-action-warning">
                    <i class="fa-solid fa-circle-play"></i> Start Free Trial <x-spinner for="startTrial" />
                </button>
            @endif

            {{-- LOGIN SHORTCUT --}}
            @if ($status === 'trial' || $status === 'active')
                <a href="{{ route('login') }}" class="btn-lic-action btn-action-success">
                    Go to Login <i class="fa-solid fa-right-to-bracket" style="margin-left: 4px;"></i>
                </a>
            @endif
        </div>
    </div>
</div>

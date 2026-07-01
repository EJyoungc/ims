@extends('layouts.public')

@section('content')
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
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            color: var(--text-primary);
        }

        .login-wrapper {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            z-index: 10;
        }

        /* Animated Ambient Lights */
        .ambient-light {
            position: absolute;
            width: 40vw;
            height: 40vw;
            border-radius: 50%;
            filter: blur(140px);
            opacity: 0.15;
            pointer-events: none;
            z-index: 1;
            animation: floatGlow 15s infinite alternate ease-in-out;
        }

        .ambient-light-1 {
            top: -10%;
            left: 10%;
            background: #6366f1;
        }

        .ambient-light-2 {
            bottom: -10%;
            right: 10%;
            background: #d946ef;
            animation-delay: -5s;
        }

        @keyframes floatGlow {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(5%, 8%) scale(1.1); }
        }

        /* Glassmorphism Container */
        .login-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            z-index: 5;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            box-shadow: 0 30px 60px -10px rgba(99, 102, 241, 0.15);
        }

        /* Logo Area */
        .brand-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-logo-img {
            max-height: 80px;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 12px rgba(255,255,255,0.1));
        }

        .brand-name {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 30%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 2px;
            margin: 0;
        }

        .brand-subtitle {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-top: 0.4rem;
            font-weight: 400;
        }

        /* Custom Input Styling */
        .input-group-custom {
            position: relative;
            margin-bottom: 1.8rem;
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
            transition: color 0.3s ease;
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

        /* Remember Me & Recover Link */
        .auth-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            user-select: none;
            color: var(--text-secondary);
        }

        .checkbox-container input {
            display: none;
        }

        .checkbox-custom {
            width: 18px;
            height: 18px;
            border: 1.5px solid var(--border-color);
            border-radius: 6px;
            margin-right: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .checkbox-container input:checked + .checkbox-custom {
            background-color: var(--accent-primary);
            border-color: var(--accent-primary);
        }

        .checkbox-custom::after {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color: #fff;
            font-size: 0.7rem;
            display: none;
        }

        .checkbox-container input:checked + .checkbox-custom::after {
            display: block;
        }

        .recover-link {
            color: var(--accent-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .recover-link:hover {
            color: var(--accent-hover);
            text-decoration: underline;
        }

        /* Premium Submit Button */
        .btn-submit-premium {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent-primary) 0%, #4f46e5 100%);
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .btn-submit-premium:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
            background: linear-gradient(135deg, var(--accent-hover) 0%, #4338ca 100%);
        }

        .btn-submit-premium:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-submit-premium:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Custom Validation Errors */
        .error-message {
            color: #f87171;
            font-size: 0.8rem;
            margin-top: 0.4rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Loading spinner */
        .spinner-custom {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>

    <div class="ambient-light ambient-light-1"></div>
    <div class="ambient-light ambient-light-2"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="brand-header">
                <img src="{{ asset('dist/img/IMS logo 128 x128.png') }}" class="brand-logo-img" alt="IMS Logo">
                <h1 class="brand-name">IMS</h1>
                <p class="brand-subtitle">Inventory Management System</p>
            </div>

            <form method="POST" id="loginForm" action="{{ route('login') }}">
                @csrf
                
                <!-- Username/Email Field -->
                <div class="input-group-custom">
                    <label for="email">Username</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" class="input-control-custom" name="email" required autocomplete="username" placeholder="Enter your email">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    @error('email')
                        <span class="error-message"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="input-group-custom">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" class="input-control-custom" name="password" required autocomplete="current-password" placeholder="••••••••">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    @error('password')
                        <span class="error-message"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>

                <!-- Actions Line (Remember Me & Forgot Pass) -->
                <div class="auth-actions">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember" id="remember" checked>
                        <div class="checkbox-custom"></div>
                        Remember this Device
                    </label>

                    @if (config('auth.password_recovery') === 'questions')
                        <a class="recover-link" href="{{ route('password.questions') }}">Forgot password?</a>
                    @else
                        <a class="recover-link" href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>

                <!-- Sign In Button -->
                <button type="submit" onclick="clickit()" id="loginBtn" class="btn-submit-premium">
                    <span id="btnText">Sign In</span>
                    <span id="loginSpinner" class="spinner-custom d-none"></span>
                </button>
            </form>
        </div>
    </div>

    <script>
        function clickit() {
            const form = document.getElementById('loginForm');
            const btn = document.getElementById('loginBtn');
            const spinner = document.getElementById('loginSpinner');
            const btnText = document.getElementById('btnText');
            
            // Trigger browser validation before disabling button
            if (form.checkValidity()) {
                btn.disabled = true;
                spinner.classList.remove('d-none');
                btnText.textContent = 'Signing In...';
                form.submit();
            }
        }
    </script>
@endsection

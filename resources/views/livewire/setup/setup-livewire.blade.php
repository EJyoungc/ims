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

        .settings-wrapper {
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
        .settings-card {
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
        .brand-header-settings {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-logo-img {
            max-height: 70px;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 12px rgba(255,255,255,0.1));
        }

        .settings-title {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 30%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
        }

        .settings-subtitle {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
        }

        /* Sections Grid Layout */
        .sections-grid {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .section-box {
            background: rgba(15, 23, 42, 0.3);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 2rem;
        }

        .section-box-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #a5b4fc;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.75rem;
        }

        /* Form Controls */
        .row-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
        }

        .input-group-custom {
            margin-bottom: 1.25rem;
        }

        .input-group-custom label {
            display: block;
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 0.5rem;
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
            padding: 12px 16px 12px 44px;
            background: rgba(15, 23, 42, 0.6);
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 0.95rem;
            font-family: inherit;
            outline: none;
            box-sizing: border-box;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-control-custom:focus {
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px var(--accent-glow);
            background: rgba(15, 23, 42, 0.8);
        }

        .input-control-custom:focus + i {
            color: var(--accent-primary);
        }

        .textarea-custom {
            width: 100%;
            min-height: 100px;
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
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
        }

        .select-custom {
            width: 100%;
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 0.95rem;
            font-family: inherit;
            outline: none;
            box-sizing: border-box;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .select-custom option {
            background-color: #0f172a;
            color: #fff;
        }

        /* File Upload */
        .file-upload-wrapper {
            background: rgba(255, 255, 255, 0.02);
            border: 1.5px dashed var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .file-upload-wrapper:hover {
            border-color: var(--accent-primary);
            background: rgba(99, 102, 241, 0.02);
        }

        .file-upload-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .logo-preview-img {
            max-width: 120px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            margin-top: 1rem;
        }

        /* Save Button */
        .btn-settings-save {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 28px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            border: none;
            background: linear-gradient(135deg, var(--accent-primary) 0%, #4f46e5 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
            width: 100%;
        }

        .btn-settings-save:hover {
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
            transform: translateY(-2px);
        }

        .btn-settings-save:active {
            transform: translateY(0);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--text-primary);
        }
    </style>

    <div class="ambient-light ambient-light-1"></div>
    <div class="ambient-light ambient-light-2"></div>

    <div class="settings-wrapper">
        <div class="settings-card">
            <div class="brand-header-settings">
                <img src="{{ asset('dist/img/IMS logo 128 x128.png') }}" class="brand-logo-img" alt="IMS Logo">
                <h1 class="settings-title">System Settings</h1>
                <p class="settings-subtitle">Manage organization data and business configurations</p>
            </div>

            <form wire:submit.prevent="save">
                <div class="sections-grid">
                    
                    <!-- Section 1: System Information -->
                    <div class="section-box">
                        <div class="section-box-title">
                            <i class="fa-solid fa-circle-info"></i> System Information
                        </div>

                        <div class="input-group-custom">
                            <label>System Organization Name</label>
                            <div class="input-wrapper">
                                <input type="text" class="input-control-custom" wire:model="system_organization_name" placeholder="Enter Organization Name">
                                <i class="fa-solid fa-building"></i>
                            </div>
                        </div>

                        <div class="row-grid">
                            <div class="input-group-custom">
                                <label>Phone 1</label>
                                <div class="input-wrapper">
                                    <input type="text" class="input-control-custom" wire:model="system_phone_1" placeholder="Phone 1">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                            </div>
                            <div class="input-group-custom">
                                <label>Phone 2</label>
                                <div class="input-wrapper">
                                    <input type="text" class="input-control-custom" wire:model="system_phone_2" placeholder="Phone 2">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                            </div>
                            <div class="input-group-custom">
                                <label>Phone 3</label>
                                <div class="input-wrapper">
                                    <input type="text" class="input-control-custom" wire:model="system_phone_3" placeholder="Phone 3">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-group-custom" style="margin-top: 1rem;">
                            <label>System Logo</label>
                            <div class="file-upload-wrapper">
                                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 1.5rem; color: var(--text-secondary); margin-bottom: 0.5rem; display: block;"></i>
                                <span style="font-size: 0.9rem; color: var(--text-secondary);">Click or drag file here to upload logo</span>
                                <input type="file" class="file-upload-input" wire:model="logo">
                            </div>
                            
                            @if ($logo)
                                <div style="text-align: center;">
                                    <img src="{{ is_string($logo) ? asset('storage/'.$logo) : $logo->temporaryUrl() }}"
                                         alt="Logo Preview" class="logo-preview-img">
                                </div>
                            @elseif($existing_logo)
                                <div style="text-align: center;">
                                    <img src="{{ asset('storage/'.$existing_logo) }}" alt="Current Logo" class="logo-preview-img">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Section 2: Shop Information -->
                    <div class="section-box">
                        <div class="section-box-title">
                            <i class="fa-solid fa-shop"></i> Shop Information
                        </div>

                        <div class="row-grid">
                            <div class="input-group-custom">
                                <label>Shop Name</label>
                                <div class="input-wrapper">
                                    <input type="text" class="input-control-custom" wire:model="shop_name" placeholder="Shop Name">
                                    <i class="fa-solid fa-store"></i>
                                </div>
                            </div>
                            <div class="input-group-custom">
                                <label>Shop Email</label>
                                <div class="input-wrapper">
                                    <input type="email" class="input-control-custom" wire:model="shop_email" placeholder="Shop Email">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-group-custom">
                            <label>Shop Phone</label>
                            <div class="input-wrapper">
                                <input type="text" class="input-control-custom" wire:model="shop_phone" placeholder="Shop Phone">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                        </div>

                        <div class="input-group-custom">
                            <label>Shop Address</label>
                            <textarea class="textarea-custom" wire:model="shop_address" placeholder="Physical shop address..."></textarea>
                        </div>
                    </div>

                    <!-- Section 3: Business Settings -->
                    <div class="section-box">
                        <div class="section-box-title">
                            <i class="fa-solid fa-sliders"></i> Business Settings
                        </div>

                        <div class="row-grid">
                            <div class="input-group-custom">
                                <label>Markup Percentage (%)</label>
                                <div class="input-wrapper">
                                    <input type="number" step="0.01" class="input-control-custom" wire:model="markup_percentage" style="padding-left: 16px;">
                                </div>
                                <small style="color: var(--text-secondary); font-size: 0.8rem; margin-top: 0.25rem; display: block;">Default pricing profit markup</small>
                            </div>

                            <div class="input-group-custom">
                                <label>Tax Percentage (%)</label>
                                <div class="input-wrapper">
                                    <input type="number" step="0.01" class="input-control-custom" wire:model="tax_percentage" style="padding-left: 16px;">
                                </div>
                            </div>
                        </div>

                        <div class="row-grid" style="margin-top: 1rem;">
                            <div class="input-group-custom">
                                <label>POS Enabled</label>
                                <select class="select-custom" wire:model="pos_enabled">
                                    <option value="1">Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>

                            <div class="input-group-custom">
                                <label>Allow Negative Stock</label>
                                <select class="select-custom" wire:model="allow_negative_stock">
                                    <option value="0">No (Default)</option>
                                    <option value="1">Yes</option>
                                </select>
                                <small style="color: #f87171; font-size: 0.8rem; margin-top: 0.25rem; display: block;">Warning: Can cause inventory inconsistencies.</small>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Submit Button and Back Link -->
                <div style="margin-top: 3rem; display: flex; flex-direction: column; gap: 1.5rem; align-items: center; border-top: 1px solid var(--border-color); padding-top: 2rem;">
                    <button type="submit" class="btn-settings-save">
                        <i class="fa-solid fa-floppy-disk"></i> Save Settings <x-spinner for="save" />
                    </button>
                    
                    <a href="{{ route('login') }}" class="back-link">
                        <i class="fa-solid fa-arrow-left-long"></i> Return to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

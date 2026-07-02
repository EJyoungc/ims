# IMS Local Build Script
# This script automates compiling the production Windows executable installer directly on your PC.

Write-Host "=========================================" -ForegroundColor Cyan
Write-Host "   IMS Windows Local Build Automation    " -ForegroundColor Cyan
Write-Host "=========================================" -ForegroundColor Cyan

# 1. Clear caches and optimize Laravel
Write-Host "`n[1/4] Clearing cache and optimizing Laravel..." -ForegroundColor Green
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize

# 2. Compile Frontend Assets
Write-Host "`n[2/4] Installing npm dependencies and compiling Vite assets..." -ForegroundColor Green
npm.cmd install
npm.cmd run build

# 3. Compile NativePHP Electron Plugin
Write-Host "`n[3/4] Compiling NativePHP Electron Plugin..." -ForegroundColor Green
npm.cmd --prefix vendor/nativephp/desktop/resources/electron install
npm.cmd --prefix vendor/nativephp/desktop/resources/electron run plugin:build

# 4. Run NativePHP Builder
Write-Host "`n[4/4] Running NativePHP Windows compiler..." -ForegroundColor Green
php artisan native:build win x64 --no-interaction -vvv

Write-Host "`n=========================================" -ForegroundColor Cyan
Write-Host "Build Completed!" -ForegroundColor Gold
Write-Host "The installer is saved in:" -ForegroundColor Green
Write-Host "$PSScriptRoot\nativephp\electron\dist\" -ForegroundColor Yellow
Write-Host "=========================================" -ForegroundColor Cyan

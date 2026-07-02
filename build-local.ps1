# IMS Local Build & Release Script
# This script automates compiling the production Windows executable installer directly on your PC,
# and automatically uploads/publishes the asset to GitHub Releases if GitHub CLI (gh) is installed.

Write-Host "=========================================" -ForegroundColor Cyan
Write-Host "   IMS Windows Local Build & Release     " -ForegroundColor Cyan
Write-Host "=========================================" -ForegroundColor Cyan

# 1. Clear caches and optimize Laravel
Write-Host "`n[1/5] Clearing cache and optimizing Laravel..." -ForegroundColor Green
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize

# 2. Compile Frontend Assets
Write-Host "`n[2/5] Installing npm dependencies and compiling Vite assets..." -ForegroundColor Green
npm.cmd install
npm.cmd run build

# 3. Compile NativePHP Electron Plugin
Write-Host "`n[3/5] Compiling NativePHP Electron Plugin..." -ForegroundColor Green
npm.cmd --prefix vendor/nativephp/desktop/resources/electron install
npm.cmd --prefix vendor/nativephp/desktop/resources/electron run plugin:build

# 4. Run NativePHP Builder
Write-Host "`n[4/5] Running NativePHP Windows compiler..." -ForegroundColor Green
php artisan native:build win x64 --no-interaction -vvv

# Define Version and File Names
$version = "v1.0.8"
$artifactPath = "$PSScriptRoot\nativephp\electron\dist\IMS-1.0.8-setup.exe"

# 5. Publish to GitHub Releases
if (Test-Path $artifactPath) {
    Write-Host "`nArtifact compiled successfully at: $artifactPath" -ForegroundColor Green
    
    if (Get-Command gh -ErrorAction SilentlyContinue) {
        Write-Host "`n[5/5] GitHub CLI detected. Authenticating and uploading to GitHub Releases..." -ForegroundColor Green
        
        # Check if release exists
        & gh release view $version *>$null
        if ($LASTEXITCODE -eq 0) {
            Write-Host "Release $version exists. Uploading/Updating installer asset..." -ForegroundColor Yellow
            & gh release upload $version "${artifactPath}" --clobber
        } else {
            Write-Host "Creating new GitHub Release $version and uploading asset..." -ForegroundColor Yellow
            & gh release create $version "${artifactPath}" --title "Release $version" --notes "Production Windows Build compiled locally on $(Get-Date -Format 'yyyy-MM-dd HH:mm')"
        }
        
        if ($LASTEXITCODE -eq 0) {
            Write-Host "`n=========================================" -ForegroundColor Cyan
            Write-Host "Success! The local build is now live on GitHub Releases!" -ForegroundColor Gold
            Write-Host "=========================================" -ForegroundColor Cyan
        } else {
            Write-Host "`nGitHub upload completed with exit code: $LASTEXITCODE" -ForegroundColor Yellow
        }
    } else {
        Write-Host "`n[5/5] GitHub CLI (gh) is not installed or configured." -ForegroundColor Yellow
        Write-Host "To automate uploads, install the GitHub CLI (https://cli.github.com) and run 'gh auth login'." -ForegroundColor Yellow
        Write-Host "Alternatively, you can manually upload the file at:" -ForegroundColor Yellow
        Write-Host "-> $artifactPath" -ForegroundColor Yellow
    }
} else {
    Write-Error "Build failed: Could not find compiled executable at $artifactPath"
}

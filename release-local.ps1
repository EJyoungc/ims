# IMS GitHub Release Upload Script
# This script uploads the compiled IMS-1.0.8-setup.exe installer to GitHub Releases.

Write-Host "=========================================" -ForegroundColor Cyan
Write-Host "     IMS GitHub Release Publisher       " -ForegroundColor Cyan
Write-Host "=========================================" -ForegroundColor Cyan

# Define Version and File Names
$version = "v1.0.8"
$artifactPath = "$PSScriptRoot\nativephp\electron\dist\IMS-1.0.8-setup.exe"

# 1. Verify Built Installer Exists
if (-not (Test-Path $artifactPath)) {
    Write-Error "Could not find built installer at: $artifactPath"
    Write-Host "Please run './build-local.ps1' first to compile the installer." -ForegroundColor Yellow
    exit 1
}

Write-Host "Found installer at: $artifactPath" -ForegroundColor Green

# 2. Publish to GitHub Releases
if (Get-Command gh -ErrorAction SilentlyContinue) {
    Write-Host "`nGitHub CLI detected. Uploading to GitHub Releases..." -ForegroundColor Green
    
    # Check if release exists
    & gh release view $version *>$null
    if ($LASTEXITCODE -eq 0) {
        Write-Host "Release $version already exists. Uploading/Updating installer asset..." -ForegroundColor Yellow
        & gh release upload $version "${artifactPath}" --clobber
    } else {
        Write-Host "Creating new GitHub Release $version and uploading asset..." -ForegroundColor Yellow
        & gh release create $version "${artifactPath}" --title "Release $version" --notes "Production Windows Build compiled locally on $(Get-Date -Format 'yyyy-MM-dd HH:mm')"
    }
    
    if ($LASTEXITCODE -eq 0) {
        Write-Host "`n=========================================" -ForegroundColor Cyan
        Write-Host "Success! The installer has been released on GitHub!" -ForegroundColor Gold
        Write-Host "=========================================" -ForegroundColor Cyan
    } else {
        Write-Host "`nGitHub upload failed with exit code: $LASTEXITCODE" -ForegroundColor Red
        Write-Host "Please ensure you have run 'gh auth login' to authenticate with GitHub." -ForegroundColor Yellow
    }
} else {
    Write-Host "`nGitHub CLI (gh) is not installed or configured." -ForegroundColor Red
    Write-Host "To automate uploads, install the GitHub CLI (https://cli.github.com) and run 'gh auth login'." -ForegroundColor Yellow
}

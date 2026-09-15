# push_to_github.ps1
# Script PowerShell otomatis untuk sync & push ke GitHub pendarloka

param(
    [string]$Message = "update: sync changes to pendarloka repository",
    [string]$Token = ""
)

$git = "$env:LOCALAPPDATA\Programs\Git\cmd\git.exe"
if (-not (Test-Path $git)) {
    $git = "git"
}

if ($Token -ne "") {
    & $git remote set-url origin "https://${Token}@github.com/alimalisi12-cpu/pendarloka.git"
    Write-Host "[OK] Remote origin telah diperbarui dengan GitHub Token." -ForegroundColor Green
}

Write-Host "=== Pendar Loka Auto Push ===" -ForegroundColor Cyan
Write-Host "Staging files..." -ForegroundColor Gray
& $git add -A

Write-Host "Committing with message: $Message" -ForegroundColor Gray
& $git commit -m $Message

Write-Host "Pushing to main..." -ForegroundColor Gray
& $git push -u origin main

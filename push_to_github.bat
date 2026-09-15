@echo off
setlocal enabledelayedexpansion
title Pendar Loka - Auto Git Push
cd /d "%~dp0"

echo ========================================================
echo   PENDAR LOKA - AUTO PUSH TO GITHUB
echo   Repo: https://github.com/alimalisi12-cpu/pendarloka
echo ========================================================
echo.

set GIT_CMD="%LOCALAPPDATA%\Programs\Git\cmd\git.exe"
if not exist %GIT_CMD% (
    set GIT_CMD=git
)

set MSG=%*
if "%MSG%"=="" (
    set /p MSG="Masukkan pesan update / commit (atau tekan Enter untuk default): "
)
if "%MSG%"=="" (
    set MSG=update: sync changes to pendarloka repository
)

echo [1/3] Menambahkan file yang diubah (git add -A)...
%GIT_CMD% add -A

echo [2/3] Membuat commit...
%GIT_CMD% commit -m "%MSG%"

echo [3/3] Melakukan push ke origin main...
%GIT_CMD% push -u origin main

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo ========================================================
    echo [PERHATIAN] Git Push memerlukan otentikasi GitHub Token.
    echo.
    echo 1. Buat token di: https://github.com/settings/tokens (pilih repo scope)
    echo 2. Masukkan token Anda di bawah ini untuk menyimpan kredensial:
    echo ========================================================
    set /p GH_TOKEN="Masukkan GitHub Personal Access Token: "
    if not "!GH_TOKEN!"=="" (
        %GIT_CMD% remote set-url origin https://!GH_TOKEN!@github.com/alimalisi12-cpu/pendarloka.git
        echo Mencoba push kembali dengan token...
        %GIT_CMD% push -u origin main
    )
)

echo.
echo Selesai!
pause

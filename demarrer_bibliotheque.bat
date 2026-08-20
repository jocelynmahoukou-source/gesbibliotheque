@echo off
title Bibliotheque - Laravel + Vite

echo ==========================================
echo       DEMARRAGE DU PROJET BIBLIOTHEQUE
echo ==========================================
echo.

echo [1/4] Demarrage de Apache...
start "" "C:\xampp\apache_start.bat"

echo [2/4] Demarrage de MySQL...
start "" "C:\xampp\mysql_start.bat"

timeout /t 5 /nobreak >nul

echo [3/4] Demarrage de Laravel...
start "Laravel" cmd /k "cd /d C:\xampp\htdocs\bibliotheque && php artisan serve --host=127.0.0.1 --port=8000"

echo.
echo Attente du demarrage de Laravel...

:WAIT_LARAVEL
powershell -NoProfile -Command "if (Test-NetConnection -ComputerName 127.0.0.1 -Port 8000 -InformationLevel Quiet) { exit 0 } else { exit 1 }"

if errorlevel 1 (
    timeout /t 2 /nobreak >nul
    goto WAIT_LARAVEL
)

echo Laravel est demarre !

echo [4/4] Demarrage de Vite...
start "Vite" cmd /k "cd /d C:\xampp\htdocs\bibliotheque && npm run dev"

timeout /t 3 /nobreak >nul

echo Ouverture de la page de connexion...
start "" "http://127.0.0.1:8000/login"

echo.
echo ==========================================
echo       PROJET BIBLIOTHEQUE DEMARRE
echo ==========================================
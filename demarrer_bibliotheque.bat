@echo off
REM ============================================================
REM   DEMARRAGE AUTOMATIQUE DU PROJET LARAVEL "BIBLIOTHEQUE"
REM ============================================================

REM Définit le titre de la fenêtre principale
title Bibliotheque - Laravel + Vite


REM ------------------------------------------------------------
REM 1. DEMARRAGE D'APACHE
REM ------------------------------------------------------------

echo ==========================================
echo       DEMARRAGE DU PROJET BIBLIOTHEQUE
echo ==========================================
echo.

echo [1/4] Demarrage de Apache...

REM Lance Apache de XAMPP
start "" "C:\xampp\apache_start.bat"


REM ------------------------------------------------------------
REM 2. DEMARRAGE DE MYSQL
REM ------------------------------------------------------------

echo [2/4] Demarrage de MySQL...

REM Lance MySQL de XAMPP
start "" "C:\xampp\mysql_start.bat"


REM ------------------------------------------------------------
REM 3. PETITE ATTENTE
REM ------------------------------------------------------------

REM Attend 5 secondes afin de laisser Apache et MySQL démarrer
timeout /t 5 /nobreak >nul


REM ------------------------------------------------------------
REM 4. DEMARRAGE DU SERVEUR LARAVEL
REM ------------------------------------------------------------

echo [3/4] Demarrage de Laravel...

REM Ouvre une nouvelle fenêtre CMD
REM Se déplace dans le dossier du projet
REM Puis lance le serveur Laravel sur le port 8000
start "Laravel" cmd /k "cd /d C:\xampp\htdocs\bibliotheque && php artisan serve --host=127.0.0.1 --port=8000"


REM ------------------------------------------------------------
REM 5. ATTENDRE QUE LARAVEL SOIT REELLEMENT DISPONIBLE
REM ------------------------------------------------------------

echo.
echo Attente du demarrage de Laravel...


REM Cette étiquette permet de recommencer le test
:WAIT_LARAVEL

REM Vérifie si le port 8000 de Laravel est accessible
REM 127.0.0.1 = ordinateur local
REM 8000 = port utilisé par Laravel
powershell -NoProfile -Command "if (Test-NetConnection -ComputerName 127.0.0.1 -Port 8000 -InformationLevel Quiet) { exit 0 } else { exit 1 }"


REM Si le port 8000 n'est pas encore disponible,
REM on attend 2 secondes puis on recommence le test
if errorlevel 1 (
    timeout /t 2 /nobreak >nul
    goto WAIT_LARAVEL
)


REM Si on arrive ici, Laravel répond correctement
echo Laravel est demarre !


REM ------------------------------------------------------------
REM 6. DEMARRAGE DE VITE / NPM
REM ------------------------------------------------------------

echo [4/4] Demarrage de Vite...

REM Ouvre une nouvelle fenêtre CMD
REM Se déplace dans le projet
REM Puis lance npm run dev
start "Vite" cmd /k "cd /d C:\xampp\htdocs\bibliotheque && npm run dev"


REM ------------------------------------------------------------
REM 7. PETITE ATTENTE AVANT LE NAVIGATEUR
REM ------------------------------------------------------------

REM Laisse quelques secondes à Vite pour démarrer
timeout /t 3 /nobreak >nul


REM ------------------------------------------------------------
REM 8. OUVERTURE AUTOMATIQUE DU NAVIGATEUR
REM ------------------------------------------------------------

echo Ouverture de la page de connexion...

REM Ouvre Microsoft Edge / navigateur par défaut
REM directement sur la page de connexion Laravel
start "" "http://127.0.0.1:8000/login"


REM ------------------------------------------------------------
REM 9. MESSAGE FINAL
REM ------------------------------------------------------------

echo.
echo ==========================================
echo       PROJET BIBLIOTHEQUE DEMARRE
echo ==========================================
echo.
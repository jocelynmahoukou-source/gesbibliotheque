@echo off
setlocal EnableExtensions EnableDelayedExpansion

REM ============================================================
REM                 BIBLIOAPP - INSTALLATEUR
REM ============================================================
REM
REM Ce programme prépare automatiquement le projet Laravel :
REM
REM   1. Vérification de XAMPP
REM   2. Démarrage d'Apache
REM   3. Démarrage de MySQL
REM   4. Vérification de PHP
REM   5. Vérification de Composer
REM   6. Vérification de Node.js
REM   7. Configuration du fichier .env
REM   8. Création de la base de données
REM   9. Installation de Composer
REM  10. Génération de la clé Laravel
REM  11. Migration de la base de données
REM  12. Installation/compilation des assets
REM  13. Nettoyage des caches
REM  14. Lancement de Laravel
REM  15. Ouverture automatique du navigateur
REM
REM ============================================================


REM ============================================================
REM CONFIGURATION DE LA CONSOLE
REM ============================================================

REM Active l'encodage UTF-8 pour les caractères accentués.
chcp 65001 >nul

REM Définit le titre de la fenêtre CMD.
title BiblioApp - Installateur

REM Définit la couleur :
REM 0 = fond noir
REM A = texte vert clair.
color 0A

echo.
echo ============================================================
echo              BIBLIOAPP - INSTALLATEUR
echo        Systeme de gestion de bibliotheque
echo ============================================================
echo.


REM ============================================================
REM 0 - VERIFICATION DE XAMPP
REM ============================================================

echo [0/7] Verification de XAMPP...
echo.

REM Vérifie que le dossier XAMPP existe.
if not exist "C:\xampp" (
    echo [ERREUR] XAMPP est introuvable dans C:\xampp
    echo.
    echo Installez XAMPP ou verifiez son emplacement.
    echo.
    pause
    exit /b 1
)

echo [OK] XAMPP trouve dans C:\xampp
echo.


REM ============================================================
REM 1 - DEMARRAGE D'APACHE
REM ============================================================

echo [1/7] Demarrage d'Apache...
echo.

REM Vérifie que le fichier de démarrage Apache existe.
if not exist "C:\xampp\apache_start.bat" (
    echo [ERREUR] Le fichier apache_start.bat est introuvable.
    echo.
    pause
    exit /b 1
)

REM Lance Apache dans une nouvelle fenêtre.
start "" "C:\xampp\apache_start.bat"

REM Attend 3 secondes afin de laisser Apache démarrer.
timeout /t 3 /nobreak >nul

echo [OK] Apache demarre.
echo.


REM ============================================================
REM 2 - DEMARRAGE DE MYSQL
REM ============================================================

echo [2/7] Demarrage de MySQL...
echo.

REM Vérifie que le fichier de démarrage MySQL existe.
if not exist "C:\xampp\mysql_start.bat" (
    echo [ERREUR] Le fichier mysql_start.bat est introuvable.
    echo.
    pause
    exit /b 1
)

REM Lance MySQL dans une nouvelle fenêtre.
start "" "C:\xampp\mysql_start.bat"

REM Attend 5 secondes afin de laisser MySQL démarrer.
timeout /t 5 /nobreak >nul

echo [OK] MySQL demarre.
echo.


REM ============================================================
REM 3 - VERIFICATION DE PHP
REM ============================================================

echo [3/7] Verification de PHP...
echo.

REM Vérifie si la commande PHP est accessible.
php -v >nul 2>&1

if errorlevel 1 (
    echo [ERREUR] PHP est introuvable.
    echo.
    echo Verifiez que C:\xampp\php est ajoute au PATH Windows.
    echo.
    pause
    exit /b 1
)

REM Affiche la version de PHP.
for /f %%v in ('php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;"') do set "PHP_VER=%%v"

echo [OK] PHP !PHP_VER! detecte.
echo.


REM ============================================================
REM 4 - VERIFICATION DE COMPOSER
REM ============================================================

echo [4/7] Verification de Composer...
echo.

REM Vérifie si Composer est installé.
composer -V >nul 2>&1

if errorlevel 1 (
    echo [ERREUR] Composer est introuvable.
    echo.
    echo Installez Composer depuis :
    echo https://getcomposer.org
    echo.
    pause
    exit /b 1
)

echo [OK] Composer detecte.
echo.


REM ============================================================
REM 5 - VERIFICATION DE NODE.JS
REM ============================================================

echo [5/7] Verification de Node.js...
echo.

REM Vérifie si Node.js est installé.
node -v >nul 2>&1

if errorlevel 1 (

    echo [AVERTISSEMENT] Node.js est introuvable.
    echo Les fichiers CSS/JS ne seront pas compiles.
    echo.

    set "NO_NODE=1"

) else (

    for /f %%v in ('node -v') do set "NODE_VER=%%v"

    echo [OK] Node.js !NODE_VER! detecte.

    set "NO_NODE=0"
)

echo.


REM ============================================================
REM 6 - CONFIGURATION DU PROJET LARAVEL
REM ============================================================

echo ============================================================
echo              CONFIGURATION DE L'ENVIRONNEMENT
echo ============================================================
echo.


REM Vérifie si le fichier .env existe déjà.
if not exist ".env" (

    REM Si .env n'existe pas, on utilise .env.example.
    if exist ".env.example" (

        copy ".env.example" ".env" >nul

        echo [OK] Fichier .env cree depuis .env.example.

    ) else (

        echo [ERREUR] Le fichier .env.example est introuvable.
        echo.
        pause
        exit /b 1
    )

) else (

    echo [OK] Le fichier .env existe deja.

)

echo.


REM ============================================================
REM CONFIGURATION MYSQL
REM ============================================================

echo ------------------------------------------------------------
echo              CONFIGURATION DE MYSQL
echo ------------------------------------------------------------
echo.

REM Adresse du serveur MySQL.
set /p "DB_HOST=Hote MySQL [127.0.0.1] : "

if "!DB_HOST!"=="" set "DB_HOST=127.0.0.1"


REM Port MySQL.
set /p "DB_PORT=Port MySQL [3306] : "

if "!DB_PORT!"=="" set "DB_PORT=3306"


REM Nom de la base de données.
set /p "DB_NAME=Nom de la BDD [bibliotheque] : "

if "!DB_NAME!"=="" set "DB_NAME=bibliotheque"


REM Utilisateur MySQL.
set /p "DB_USER=Utilisateur MySQL [root] : "

if "!DB_USER!"=="" set "DB_USER=root"


REM Mot de passe MySQL.
REM Dans une installation XAMPP classique, il est souvent vide.
set /p "DB_PASS=Mot de passe MySQL (laisser vide si aucun) : "

echo.


REM ============================================================
REM MISE A JOUR DU FICHIER .ENV
REM ============================================================

echo Configuration du fichier .env...
echo.


REM Met à jour l'hôte MySQL.
powershell -NoProfile -Command "(Get-Content '.env') -replace '^DB_HOST=.*', 'DB_HOST=!DB_HOST!' | Set-Content '.env'"

REM Met à jour le port MySQL.
powershell -NoProfile -Command "(Get-Content '.env') -replace '^DB_PORT=.*', 'DB_PORT=!DB_PORT!' | Set-Content '.env'"

REM Met à jour le nom de la base.
powershell -NoProfile -Command "(Get-Content '.env') -replace '^DB_DATABASE=.*', 'DB_DATABASE=!DB_NAME!' | Set-Content '.env'"

REM Met à jour l'utilisateur MySQL.
powershell -NoProfile -Command "(Get-Content '.env') -replace '^DB_USERNAME=.*', 'DB_USERNAME=!DB_USER!' | Set-Content '.env'"

REM Met à jour le mot de passe MySQL.
powershell -NoProfile -Command "(Get-Content '.env') -replace '^DB_PASSWORD=.*', 'DB_PASSWORD=!DB_PASS!' | Set-Content '.env'"

REM Configure le nom de l'application.
powershell -NoProfile -Command "(Get-Content '.env') -replace '^APP_NAME=.*', 'APP_NAME=BiblioApp' | Set-Content '.env'"

REM Configure l'adresse de l'application.
powershell -NoProfile -Command "(Get-Content '.env') -replace '^APP_URL=.*', 'APP_URL=http://127.0.0.1:8000' | Set-Content '.env'"

echo [OK] Fichier .env configure.
echo.


REM ============================================================
REM CREATION DE LA BASE DE DONNEES
REM ============================================================

echo ============================================================
echo              CREATION DE LA BASE DE DONNEES
echo ============================================================
echo.

REM Essaie de créer la base de données.
REM IF NOT EXISTS signifie que la base ne sera pas recréée
REM si elle existe déjà.

mysql -h "!DB_HOST!" -P "!DB_PORT!" -u "!DB_USER!" --password="!DB_PASS!" -e "CREATE DATABASE IF NOT EXISTS \`!DB_NAME!\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" >nul 2>&1

if errorlevel 1 (

    echo [ERREUR] Impossible de creer la base de donnees.
    echo.
    echo Verifiez :
    echo - Que MySQL est demarre dans XAMPP
    echo - L'utilisateur MySQL
    echo - Le mot de passe MySQL
    echo - Le port MySQL
    echo.

    pause
    exit /b 1

) else (

    echo [OK] Base de donnees "!DB_NAME!" prete.

)

echo.


REM ============================================================
REM INSTALLATION DES DEPENDANCES PHP
REM ============================================================

echo ============================================================
echo              INSTALLATION DE COMPOSER
echo ============================================================
echo.

REM Installe les dépendances PHP du projet Laravel.
composer install --no-interaction --optimize-autoloader

if errorlevel 1 (

    echo.
    echo [ERREUR] Composer a rencontre une erreur.
    echo.
    pause
    exit /b 1

)

echo.
echo [OK] Dependances PHP installees.
echo.


REM ============================================================
REM GENERATION DE LA CLE LARAVEL
REM ============================================================

echo Generation de la cle Laravel...
echo.

REM Génère APP_KEY dans le fichier .env.
php artisan key:generate

if errorlevel 1 (

    echo.
    echo [ERREUR] Impossible de generer la cle Laravel.
    echo.
    pause
    exit /b 1

)

echo.
echo [OK] Cle Laravel generee.
echo.


REM ============================================================
REM MIGRATIONS ET SEEDERS
REM ============================================================

echo ============================================================
echo              MIGRATION DE LA BASE DE DONNEES
echo ============================================================
echo.

REM IMPORTANT :
REM migrate crée les tables sans supprimer les tables existantes.
REM --seed exécute également DatabaseSeeder.
REM --force évite une demande de confirmation.

php artisan migrate --seed --force

if errorlevel 1 (

    echo.
    echo [ERREUR] Les migrations ont echoue.
    echo.
    echo Verifiez votre configuration MySQL dans .env.
    echo.
    pause
    exit /b 1

)

echo.
echo [OK] Base de donnees migree.
echo [OK] Seeders executes.
echo.


REM ============================================================
REM INSTALLATION DES DEPENDANCES JAVASCRIPT
REM ============================================================

echo ============================================================
echo              CONFIGURATION FRONT-END
echo ============================================================
echo.

if "!NO_NODE!"=="0" (

    REM Vérifie que package.json existe.
    if exist "package.json" (

        echo Installation des dependances NPM...
        echo.

        npm install

        if errorlevel 1 (

            echo.
            echo [ERREUR] npm install a echoue.
            echo.
            pause
            exit /b 1

        )

        echo.
        echo [OK] Dependances NPM installees.
        echo.

        echo Compilation des assets...
        echo.

        npm run build

        if errorlevel 1 (

            echo.
            echo [AVERTISSEMENT] La compilation des assets a echoue.
            echo Le serveur Laravel peut quand meme fonctionner.
            echo.

        ) else (

            echo [OK] Assets compiles.

        )

    ) else (

        echo [AVERTISSEMENT] package.json introuvable.
        echo Les assets front-end sont ignores.

    )

) else (

    echo [AVERTISSEMENT] Node.js absent.
    echo Compilation des assets ignoree.

)

echo.


REM ============================================================
REM NETTOYAGE DES CACHES LARAVEL
REM ============================================================

echo ============================================================
echo              NETTOYAGE DES CACHES
echo ============================================================
echo.

REM Efface le cache de configuration.
php artisan config:clear

REM Efface le cache général.
php artisan cache:clear

REM Efface le cache des vues Blade.
php artisan view:clear

echo.
echo [OK] Caches Laravel nettoyes.
echo.


REM ============================================================
REM INSTALLATION TERMINEE
REM ============================================================

echo.
echo ============================================================
echo              INSTALLATION TERMINEE !
echo ============================================================
echo.

echo Configuration utilisee :
echo.
echo    Base de donnees : !DB_NAME!
echo    Serveur MySQL   : !DB_HOST!
echo    Port MySQL      : !DB_PORT!
echo    Utilisateur     : !DB_USER!
echo.
echo    Application :
echo    http://127.0.0.1:8000
echo.

echo ============================================================
echo.


REM ============================================================
REM DEMARRAGE DU SERVEUR LARAVEL
REM ============================================================

set /p "LAUNCH=Lancer BiblioApp maintenant ? [O/n] : "

REM Si l'utilisateur tape "n", le serveur ne sera pas lancé.
if /i "!LAUNCH!"=="n" (

    echo.
    echo Installation terminee.
    echo.
    pause
    exit /b 0

)


REM ============================================================
REM OUVERTURE DU NAVIGATEUR
REM ============================================================

echo.
echo Demarrage du serveur Laravel...
echo.
echo Adresse :
echo http://127.0.0.1:8000
echo.
echo Pour arreter Laravel, appuyez sur CTRL+C.
echo.


REM Ouvre le navigateur par défaut.
start "" "http://127.0.0.1:8000"


REM Lance le serveur Laravel.
php artisan serve


REM ============================================================
REM FIN
REM ============================================================

echo.
echo ============================================================
echo              SERVEUR LARAVEL ARRETE
echo ============================================================
echo.

pause
endlocal
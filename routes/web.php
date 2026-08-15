<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, DashboardController, LivreController,
    AuteurController, CategorieController, AdherentController, EmpruntController
};

// ─── AUTH (non protégées) ────────────────────────────────────────────────────
Route::middleware('guest:admin')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── APP (protégées par auth admin) ─────────────────────────────────────────
Route::middleware('auth.admin')->group(function () {
    Route::get('/', fn() => redirect()->route('dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('livres',    LivreController::class);
    Route::resource('auteurs',   AuteurController::class)->except(['show']);
    Route::resource('categories',CategorieController::class)->except(['show','create']);
    Route::resource('adherents', AdherentController::class);
    Route::resource('emprunts',  EmpruntController::class)->except(['show']);
    Route::patch('/emprunts/{emprunt}/retour', [EmpruntController::class, 'retour'])->name('emprunts.retour');
    Route::get('/emprunts-en-retard', [EmpruntController::class, 'enRetard'])->name('emprunts.enRetard');
});

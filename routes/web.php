<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController,LivreController,AuteurController,CategorieController,AdherentController,EmpruntController};

Route::get('/', fn() => redirect()->route('dashboard'));
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('livres', LivreController::class);
Route::resource('auteurs', AuteurController::class)->except(['show']);
Route::resource('categories', CategorieController::class)->except(['show','create']);
Route::resource('adherents', AdherentController::class);
Route::resource('emprunts', EmpruntController::class)->except(['show']);
Route::patch('/emprunts/{emprunt}/retour', [EmpruntController::class, 'retour'])->name('emprunts.retour');
Route::get('/emprunts-en-retard', [EmpruntController::class, 'enRetard'])->name('emprunts.enRetard');

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//route acceuil
Route::get('/accueil', [App\Http\Controllers\AccueilController::class, 'index'])->name('accueil');
//route pour afficher les vues en fonction du clic dist
Route::get('/{page}', [App\Http\Controllers\AccueilController::class, 'AfficherLesDist'])->name('dist.page');
//route pour afficher les vues en fonction du clic src
// Route::get('/{page}', [App\Http\Controllers\AccueilController::class, 'AfficherLesSrc'])->name('src.page');
//enregistrer une classe
Route::post('/ajouter-classe', [App\Http\Controllers\ClasseController::class, 'ajouterClasse'])->name('ajouter-classe');
// enregistrer eleve
Route::post('inscrire.user',[App\Http\Controllers\eleve::class,'store'])->name('eleves.store');

require __DIR__.'/auth.php';

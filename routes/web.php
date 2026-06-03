<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//route acceuil
Route::get('/', [App\Http\Controllers\AccueilController::class, 'Acceuil'])->name('accueil');
// côté classe
//ajouter une classe
Route::get('/ajouter-classe', [App\Http\Controllers\ClasseController::class, 'Ajout_Classe'])->name('ajouter_classe');
//enregistrer une classe
Route::post('/enregistrer-classe', [App\Http\Controllers\ClasseController::class, 'ajouterClasse'])->name('enregistrer-classe');
// liste des classes
Route::get('/liste-classes', [App\Http\Controllers\ClasseController::class, 'listeClasses'])->name('liste_classes');
// côté eleves
// connexion
Route::get('/connexion', [App\Http\Controllers\ElevesControler::class,'Connexion'])->name('eleves.connexion');
// côté eleves
//liste des eleves
Route::get('/liste-eleves', [App\Http\Controllers\ElevesControler::class,'ListeElelves'])->name('eleves.liste');

// profile eleves
Route::get('/profile-eleve', [App\Http\Controllers\ElevesControler::class,'profile'])->name('eleves.profile');
//formulaire d'ajout des eleves
// ajouter les eleves
Route::get('/elevesenregistrer', [App\Http\Controllers\ElevesControler::class, 'create'])->name('eleves.create');
// confirmer l'ajoute eleves nouveaux
Route::post('/eleves/nouveau', [App\Http\Controllers\ElevesControler::class, 'storeNouveauEleves'])->name('eleves.storeNouveau');
// confiermer l'ajoute eleves ancien
Route::post('/eleves/ancien', [App\Http\Controllers\ElevesControler::class, 'storeAncienEleves'])->name('eleves.store.ancien');
// modifier les eleves
Route::get('/eleves/{id}', [App\Http\Controllers\ElevesControler::class, 'edit'])->name('eleves.edit');
// mettre à jour les eleves
Route::put('/eleves/{id}', [App\Http\Controllers\ElevesControler::class, 'update'])->name('eleves.update');
// supprimer les eleves
Route::delete('/eleves/{id}', [App\Http\Controllers\ElevesControler::class, 'destroy'])->name('eleves.destroy');


// test inscription
Route::get('/testinscription',[App\Http\Controllers\InscriptionController::class,'inscriptiontest'])->name('inscriptiontest');
// Vérifier les inscriptions
Route::get('/inscription/verifier/{eleve_id}', [App\Http\Controllers\InscriptionAdmin::class, 'verifierStatut'])->name('inscription.verifier');
Route::resource('inscriptions', App\Http\Controllers\InscriptionAdmin::class);
//route pour afficher les vues en fonction du clic dist
Route::get('/{page}', [App\Http\Controllers\AccueilController::class, 'AfficherLesDist'])->name('dist.page');

require __DIR__.'/auth.php';

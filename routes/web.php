<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Annee_scolaire_controller;
use Illuminate\Support\Facades\Route;

// Route::get('/login', function () {
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
// return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//route acceuil
Route::get('/', [App\Http\Controllers\AccueilController::class, 'Acceuil'])->name('accueil');
Route::get('essaies', [App\Http\Controllers\AccueilController::class, 'essaies'])->name('accueil');

Route::middleware('auth')->group(function () {
    /// côté classe
    //ajouter une classe
    Route::get('/ajouter-classe', [App\Http\Controllers\ClasseController::class, 'Ajout_Classe'])->name('ajouter_classe');
    //enregistrer une classe
    Route::post('/enregistrer-classe', [App\Http\Controllers\ClasseController::class, 'ajouterClasse'])->name('enregistrer-classe');
    // liste des classes
    Route::get('/liste-classes', [App\Http\Controllers\ClasseController::class, 'listeClasses'])->name('liste_classes');
});

Route::middleware('auth')->group(function () {
    // côté eleves
    // connexion
    Route::get('/connexion', [App\Http\Controllers\ElevesControler::class, 'Connexion'])->name('eleves.connexion');
    // côté eleves
    //liste des eleves
    Route::get('/liste-eleves', [App\Http\Controllers\ElevesControler::class, 'ListeElelves'])->name('eleves.liste');
    // profile eleves
    Route::get('/profile-eleve', [App\Http\Controllers\ElevesControler::class, 'profile'])->name('eleves.profile');
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

    //cote année scolaire
    //formulaire d'ajout des années
    Route::get('/ajouter_annee_scolaire', [App\Http\Controllers\Annee_scolaire_controller::class, 'Ajout_AnneeScolaire'])->name('ajouter_annee_scolaire');
    //confirmer une nouvelle année scolaire
    Route::post('/enregistrer_annee_scolaire', [App\Http\Controllers\Annee_scolaire_controller::class, 'Enregistrer_annee'])->name('enregistrer_annee_scolaire');

    // test inscription
    Route::get('/testinscription', [App\Http\Controllers\InscriptionController::class, 'inscriptiontest'])->name('inscriptiontest');
    // Vérifier les inscriptions
    Route::get('/inscription/verifier/{eleve_id}', [App\Http\Controllers\InscriptionAdmin::class, 'verifierStatut'])->name('inscription.verifier');
    Route::resource('inscriptions', App\Http\Controllers\InscriptionAdmin::class);
});

Route::middleware('auth')->group(function () {
    //cote administrateur
    // programmer une session d'inscription pour les eleves
    Route::get('/programmer-inscription', [App\Http\Controllers\AdminController::class, 'Programmer_inscriptions'])->name('programmer.inscription.create');
    // enregistrer une session d'inscription pour les eleves
    Route::post('/programmer-inscription', [App\Http\Controllers\AdminController::class, 'storeInscription'])->name('programmer.inscription.store');
    // afficher les sessions d'inscription pour les eleves et les modifier
    Route::get('/les-sessions-inscriptions', [App\Http\Controllers\AdminController::class, 'Les_session_inscriptions'])->name('les_sessions_inscriptions');
    //modifier une session d'inscription pour les eleves
    //Route::get('/modifier-session-inscription/{id}', [App\Http\Controllers\AdminController::class, 'modifierSessionInscription'])->name('modifier.session_inscription');
    //mettre à jour une session d'inscription pour les eleves
    Route::put('/modifier-session-inscription/{id}', [App\Http\Controllers\AdminController::class, 'ouvrir_session_inscription'])->name('modifier.session_inscription');
    //supprimer une session d'inscription pour les eleves
    Route::delete('/supprimer-session-inscription/{id}', [App\Http\Controllers\AdminController::class, 'supprimerSessionInscription'])->name('supprimer.session_inscription');
    //cote eleves
    // effectuer son inscription côté eleves
    Route::post('/inscription_eleve', [App\Http\Controllers\InscriptionController::class, 'storeInscription'])->name('inscription.store.eleve');
    // afficher le formulaire d'inscription côté eleves
    Route::get('/inscription_eleve', [App\Http\Controllers\InscriptionController::class, 'create'])->name('inscription.create.eleve');
    //
});

//cote matiere classe
Route::middleware('auth')->group(function () {
    //formulaire d'ajout des matieres
    Route::get('/ajouter-matiere', [App\Http\Controllers\Enseignant\matiere_classe::class, 'ajouter_matiere'])->name('ajouter_une_matiere');
    //confirmer l'ajout des matieres
    Route::post('/confirmer-ajout-matiere', [App\Http\Controllers\Enseignant\matiere_classe::class, 'confirmer_ajout'])->name('confirmer_ajout_matiere');
    //formulaire d'ajout des matieres
    Route::get('/classe-matiere', [App\Http\Controllers\Enseignant\matiere_classe::class, 'create'])->name('ajouter_matiere');
    //enregistrer les matieres
    Route::post('/enregistrer-matiere', [App\Http\Controllers\Enseignant\matiere_classe::class, 'store'])->name('enregistrer_matiere');
});
//route pour afficher les vues en fonction du clic
// Route::get('/{page}', [App\Http\Controllers\AccueilController::class, 'AfficherLesDist'])->name('dist.page');
// Route::get(
//     '/anneescolaires/{id}/activer',
//     [Annee_scolaire_controller::class, 'activer']
// )->name('anneescolaires.activer');

//cote administrateur
require __DIR__ . '/auth.php';

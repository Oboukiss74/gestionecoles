<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\session_inscriptions;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //session inscririon pour les eleves

    //progtammer une session d'inscription pour les eleves
    public function Programmer_inscriptions(request $request)
    {
        $anneeActive = AnneeScolaire::where('active', true)->first();
        return view('Admin.programmation_inscription', compact('anneeActive'));
    }
    //enregistrer une session d'inscription pour les eleves
    public function storeInscription(request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'annee_scolaire_id' => 'required|exists:annee_scolaires,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
        ], [
            'libelle.required' => 'Le libellé est requis.',
            'annee_scolaire_id.required' => 'L\'année scolaire est requise.',
            'annee_scolaire_id.exists' => 'L\'année scolaire sélectionnée est invalide.',
            'date_debut.required' => 'La date de début est requise.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'date_debut.after_or_equal' => 'La date de début doit être aujourd\'hui ou une date future.',
            'date_fin.required' => 'La date de fin est requise.',
            'date_fin.date' => 'La date de fin doit être une date valide.',
            'date_fin.after' => 'La date de fin doit être postérieure à la date de début.',
        ]);


        // Vérifier si une session existe déjà pour cette période
        $existe = session_inscriptions::where('date_debut', $request->date_debut)
            ->where('date_fin', $request->date_fin)
            ->where('date_fin', $request->date_fin)
            ->exists();

        if ($existe) {
            return redirect()->back()->with('errordate', 'Cette session d\'inscription existe déjà pour cette période.');
        }

        session_inscriptions::create([
            'libelle' => $request->libelle,
            'annee_scolaire_id' => $request->annee_scolaire_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);

        return redirect()->back()->with('success', 'Session d\'inscription programmée avec succès.');
    }

    //les sessiosn d'inscription pour les eleves

    public function Les_session_inscriptions()
    {
        $sessions = session_inscriptions::orderBy('id', 'desc')->get();
        return view('Admin.les_session_inscriptions', compact('sessions'));
    }
    //modifier une session d'inscription pour les eleves
    public function ouvrir_session_inscription(Request $request, $id)
    {

        // Fermer toutes les sessions
        session_inscriptions::query()->update([
            'statut' => 'fermee'
        ]);

        // Ouvrir celle choisie
        $session = session_inscriptions::findOrFail($id);

        $session->update([
            'statut' => 'ouverte'
        ]);
        return redirect()->back()->with('success', 'Session d\'inscription mise à jour avec succès.');
    }
}

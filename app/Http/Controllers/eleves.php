<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleves;
use App\Models\Classes;
use App\Models\inscriptions;
use Illuminate\Http\Response;
use App\Models\Parents;
class eleve extends Controller
{
    public function store(Request $request) {
        dd('essaie');
        $request->validate([
            'nom'              => 'required|string',
            'prenom'           => 'required|string',
            'date_naissance'   => 'required|date',
            'sexe'             => 'required|in:M,F',
            'matricule'         => 'required|string|unique:eleves,matricule',
            'nationalite'       => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email',
            'numero_parent' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nom_parent'       => 'required|string',
            'prenom_parent'       => 'required|string',
            'residence_parent'     => 'nullable|string',
            'email_parent'     => 'required|email',
            'profession_parent'     => 'nullable|string',
            'classe_id'        => 'required|exists:classes,id',
        ]);
        // dd($request->all());

        // creer le parent
        Parents::create([

            'nom_parent' => $request->nom_parent,
            'prenom_parent' => $request->prenom_parent,
            'residence_parent' => $request->residence_parent,
            'telephone_parent' => $request->telephone,
            'email_parent' => $request->email_parent,
            'profession_parent' => $request->profession_parent,
        ]);

        // Génération du matricule : EL-2025-0001
        $matricule = 'EL-' . date('Y') . '-' . str_pad(Eleves::count() + 1, 4, '0', STR_PAD_LEFT);

        $eleve = Eleves::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe,
            'matricule' => $matricule,
            'nationalite' => $request->nationalite,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'numero_parent' => $request->numero_parent,
            'photo' => $request->photo,
            'classe_id' => $request->classe_id,
            'annee_scolaire' => anneeScolaireActuelle(),
            'statut' => 'en_attente',
            'date_inscription' => now(),
            'parent_id' => Parents::latest()->first()->id,
        ]);

        // Créer l'inscription
        Inscriptions::create([
            'eleve_id'       => $eleve->id,
            'classe_id'      => $request->classe_id,
            'annee_scolaire' => anneeScolaireActuelle(),
            'statut'         => 'en_attente',
            'date_inscription' => now(),
        ]);

        return redirect()->route('accueil')->with('success', 'Inscription soumise avec succès !');
    }
}

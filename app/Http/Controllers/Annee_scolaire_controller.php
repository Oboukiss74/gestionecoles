<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnneeScolaire;

class Annee_scolaire_controller extends Controller
{
    // formulaire d'ajout des années
    public function Ajout_AnneeScolaire()
    {

        return view('annee_scolaire.Ajout_AnneeScolaire');
    }
    //confirmer une nouvelle année scolaire
    public function Enregistrer_annee(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255|unique:annee_scolaires,libelle',
        ]);
        // Si l'année créée est active,
        // désactiver les autres.
        if ($request->has('active')) {
            AnneeScolaire::query()->update([
                'active' => false
            ]);
        }
        AnneeScolaire::create([
            'libelle' => $request->libelle,
            'active' => $request->has('active'),
        ]);
        return redirect()->back()->with('successannee', 'Année scolaire ajoutée avec succès.');
    }
}

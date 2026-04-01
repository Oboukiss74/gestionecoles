<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    //ajouter une classe
    public function ajouterClasse(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:classes,nom',
            'niveau' => 'required|string',
            'annee' => 'required|string',
        ], [
            'nom.required' => 'Le nom de la classe est obligatoire.',
            'nom.unique'   => 'Cette classe existe déjà.',
            'niveau.required' => 'Le niveau est obligatoire.',
        ]);

        // affciher un message d'erreur en cas de doublon de nom car le nom est unique dans la base de données
        // if (Classes::where('nom', $request->nom)->exists()) {
        //     return redirect()->route('ajouter-classe')->with('errorclasse', 'Le nom de la classe existe déjà !');
        // }
        Classes::create([
            'nom' => $request->nom,
            'niveau' => $request->niveau,
            'annee' => $request->annee,
        ]);
        //
        return redirect()->route('dist.page','formulaireClasses')->with('successclasse', 'Classe ajoutée avec succès !');
    }
}

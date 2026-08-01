<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Models\classes;

class matiere_classe extends Controller
{
    //ajouter les matières
    public function ajouter_matiere()
    {
        return view('matieres_classes.ajouter_matiere');
    }
    //confirmer l'ajout des matières
    public function confirmer_ajout(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            
        ], [
            'nom.required' => 'Le nom de la matière est requis.',
        ]);
  
        // Créer la matière
        Matiere::create([
            'nom' => $request->nom,
            ///'coefficient' => $request->input('coefficient', 1),
        ]);

        return redirect()->back()->with('success', 'Matière enregistrée avec succès.');
    }
    //liste des matières et a modifier les matières
    public function modifier_matiere($id)
    {
        $matiere = Matiere::findOrFail($id);
        return view('matieres_cliste_modifier.modifier_matiere', compact('matiere'));
    }
    //enregistrer les modifications des matières
    public function enregistrer_modification(Request $request, $id)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
        ], [
            'nom.required' => 'Le nom de la matière est requis.',
        ]);
        return redirect()->back()->with('success', 'Matière modifiée avec succès.');
    }
    //supprimer les matières
    public function supprimer_matiere($id)
    {
        $matiere = Matiere::findOrFail($id);
        $matiere->delete();
        return redirect()->back()->with('success', 'Matière supprimée avec succès.');
    }
    // formulaire d'ajout des matières aux classes 
    public function create()
    {
        $classes = classes::orderBy('nom')->get();
        // Récupérer les matières existantes pour les afficher dans le formulaire
        $matieres = Matiere::orderBy('nom')->get();
        return view('matieres_classes.ajouter_classe_matiere', compact('classes', 'matieres'));
    }

    // enregistrer les matières
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'classe_id' => ['required', 'array'],
            'classe_id.*' => ['exists:classes,id'],
            'coefficient' => ['required', 'integer', 'min:1'],
        ], [
            'nom.required' => 'Le nom de la matière est requis.',
            'nom.string' => 'Le nom de la matière doit être une chaîne de caractères.',
            'nom.max' => 'Le nom de la matière ne peut pas dépasser :max caractères.',
            'classe_id.array' => 'Le format des classes sélectionnées est invalide.',
            'classe_id.*.exists' => 'Une classe sélectionnée est introuvable.',
        ]);

        $selectedClasses = $request->input('classe_id', []);

        if (empty($selectedClasses)) {
            return redirect()->back()->withErrors(['classe_id' => 'Veuillez sélectionner au moins une classe.']);
        }

        $matiere = Matiere::create([
            'nom' => $request->nom,
            ///'coefficient' => $request->input('coefficient', 1),
        ]);

        // Liaison avec les classes
        foreach ($request->classe_id as $classeId) {

            $matiere->classes()->attach(
                $classeId,
                [
                    'coefficient' => $request->coefficient
                ]
            );
        }
        
        
        

        return redirect()->back()->with('success', 'Matière enregistrée avec succès.');
    }
}

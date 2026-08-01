<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\eleves;
use App\Models\Matiere;
use App\Models\Note;
class Note_eleves extends Controller
{
     // afficher le formulaire d'ajout des notes pour un élève spécifique
    public function create($eleve_id)
    {
        // Récupérer l'élève à partir de l'ID
        $eleve = eleves::findOrFail($eleve_id);
        // Récupérer les matières
        $matieres = Matiere::all();
        // Retourner la vue avec les données
        return view('enseignant.notes.create', compact('eleve', 'matieres'));
    }
    //enregistrer les notes des eleves
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'matiere_id' => 'required|exists:matieres,id',
            'note' => 'required|min:0|max:20',
        ],[
            'eleve_id.required' => 'L\'ID de l\'élève est requis.',
            'eleve_id.exists' => 'L\'élève sélectionné n\'existe pas.',
            'matiere_id.required' => 'L\'ID de la matière est requis.',
            'matiere_id.exists' => 'La matière sélectionnée n\'existe pas.',
            'note.required' => 'La note est requise.',
            'note.min' => 'La note doit être au moins :min.',
            'note.max' => 'La note ne peut pas dépasser :max.',
        ]
        );

        // Enregistrement de la note dans la base de données
        $note =Note::create(
            [
                'eleve_id' => $validatedData['eleve_id'],
                'matiere_id' => $validatedData['matiere_id'],
                'note' => $validatedData['note'],
            ]
        );
        $note->eleve_id = $validatedData['eleve_id'];
        $note->matiere_id = $validatedData['matiere_id'];
        $note->note = $validatedData['note'];
        $note->save();

        return redirect()->back()->with('success', 'Note enregistrée avec succès.');
    }
}

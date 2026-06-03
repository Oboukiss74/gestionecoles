<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\Classes;
use App\Models\Eleves;
use App\Models\Inscriptions;
use App\Models\Parents;
use Illuminate\Support\Facades\Auth;

class InscriptionAdmin extends Controller
{
    //
    /**
     * Enregistrer une nouvelle inscription côté admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_eleve'          => 'required|exists:eleves,id',
            'id_classe'         => 'required|exists:classes,id',
            'annee_scolaire_id' => 'required|exists:annee_scolaires,id',
            'date_inscription'  => 'required|date',
            'statut'            => 'required|in:en_attente,confirme,annule',
        ], [
            'id_eleve.required'          => 'Veuillez sélectionner un élève.',
            'id_eleve.exists'            => 'L\'élève sélectionné n\'existe pas.',
            'id_classe.required'         => 'Veuillez sélectionner une classe.',
            'id_classe.exists'           => 'La classe sélectionnée n\'existe pas.',
            'annee_scolaire_id.required' => 'Veuillez sélectionner une année scolaire.',
            'date_inscription.required'  => 'La date d\'inscription est obligatoire.',
            'date_inscription.date'      => 'La date d\'inscription est invalide.',
            'statut.required'            => 'Le statut est obligatoire.',
            'statut.in'                  => 'Le statut est invalide.',
        ]);

        // Vérifier qu'il n'y a pas de doublon (même élève, même classe, même année)
        $existe = Inscriptions::where('id_eleve', $validated['id_eleve'])
            ->where('annee_scolaire_id', $validated['annee_scolaire_id'])
            ->exists();

        if ($existe) {
            return back()
                ->withInput()
                ->withErrors(['id_eleve' => 'Cet élève est déjà inscrit pour cette année scolaire.']);
        }

        Inscriptions::create($validated);

        return redirect()
            ->route('inscriptions.index')
            ->with('success', 'Inscription créée avec succès.');
    }

    /**
     * Afficher le détail d'une inscription
     */
    public function show(Inscriptions $inscription)
    {
        $inscription->load(['eleve', 'classe', 'anneeScolaire']);
        return view('inscriptions.show', compact('inscription'));
    }
    /**
     * Afficher le formulaire de modification côté admin
     */
    public function edit(Inscriptions $inscription)
    {
        $eleves          = Eleves::orderBy('nom')->get();
        $classes         = Classes::all();
        $anneesScolaires = AnneeScolaire::orderBy('libelle', 'desc')->get();

        return view('inscriptions.edit', compact('inscription', 'eleves', 'classes', 'anneesScolaires'));
    }

    /**
     * Liste de toutes les inscriptions (vue admin)
     */
    public function index(Request $request)
    {
        $query = Inscriptions::with(['eleve', 'classe', 'anneeScolaire']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('eleve', function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('matricule', 'like', "%{$search}%");
            });
        }

        if ($request->filled('classe_id')) {
            $query->where('id_classe', $request->classe_id);
        }

        if ($request->filled('annee_scolaire_id')) {
            $query->where('annee_scolaire_id', $request->annee_scolaire_id);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $inscriptions    = $query->orderBy('date_inscription', 'desc')->paginate(15);
        $classes         = Classes::all();
        $anneesScolaires = AnneeScolaire::orderBy('libelle', 'desc')->get();

        return view('inscriptions.index', compact('inscriptions', 'classes', 'anneesScolaires'));
    }

    /**
     * Mettre à jour une inscription
     */
    public function update(Request $request, Inscriptions $inscription)
    {
        $validated = $request->validate([
            'id_eleve'          => 'required|exists:eleves,id',
            'id_classe'         => 'required|exists:classes,id',
            'annee_scolaire_id' => 'required|exists:annee_scolaires,id',
            'date_inscription'  => 'required|date',
            'statut'            => 'required|in:en_attente,confirme,annule',
        ]);

        $existe = Inscriptions::where('id_eleve', $validated['id_eleve'])
            ->where('annee_scolaire_id', $validated['annee_scolaire_id'])
            ->where('id', '!=', $inscription->id)
            ->exists();

        if ($existe) {
            return back()
                ->withInput()
                ->withErrors(['id_eleve' => 'Cet élève est déjà inscrit pour cette année scolaire.']);
        }

        $inscription->update($validated);

        return redirect()
            ->route('inscriptions.index')
            ->with('success', 'Inscription mise à jour avec succès.');
    }

    /**
     * Supprimer une inscription
     */
    public function destroy(Inscriptions $inscriptions)
    {
        $inscriptions->delete();

        return redirect()
            ->route('inscriptions.index')
            ->with('success', 'Inscription supprimée avec succès.');
    }

    /**
     * Vérifier le statut d'inscription d'un élève
     */
    public function verifierStatut($eleve_id)
    {
        $eleve = Eleves::findOrFail($eleve_id);
        $inscription = obtenirInscription($eleve_id);
        
        if (!$inscription) {
            return response()->json([
                'inscrit' => false,
                'eleve' => $eleve->nom . ' ' . $eleve->prenom,
                'message' => 'L\'élève n\'est pas inscrit pour cette année scolaire'
            ]);
        }

        return response()->json([
            'inscrit' => true,
            'eleve' => $eleve->nom . ' ' . $eleve->prenom,
            'matricule' => $eleve->matricule,
            'statut' => $inscription->statut_inscription,
            'classe' => optional($inscription->classe)->nom,
            'annee_scolaire' => optional($inscription->annee_scolaire)->libelle,
            'date_inscription' => $inscription->date_inscription->format('d/m/Y'),
            'message' => getMessageStatut($inscription->statut_inscription)
        ]);
    }
}

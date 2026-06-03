<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eleve_inscriptions;
use App\Models\inscriptions;
use App\Models\Eleves;
use App\Models\Classes;
use App\Models\AnneeScolaire;
use App\Models\Parents;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    //teste inscription
    public function inscriptiontest(){
        //recuperer un eleve dont l'id est 1
        $eleve = Eleves::where('id', 2)->get();
        // $eleve=Eleves::find(1);
        //$eleve=Eleves::first();
        return view('eleves.inscription_eleve',compact('eleve'));
    }
    private function eleveConnecte()
    {
        return Auth::guard('eleve')->user();
    }

    /**
     * Afficher le formulaire d'inscription
     * → anneeActive() et toutesLesClasses() viennent de helpers.php
     */
    public function showForm()
    {
        $eleve       = $this->eleveConnecte();
        $anneeActive = anneeActive();          // ← helper
        $classes     = Classes::all();

        // Vérifier si l'élève est déjà inscrit cette année
        $dejaInscrit = null;
        if ($anneeActive) {
            $dejaInscrit = Inscriptions::where('id_eleve', $eleve->id)
                ->where('annee_scolaire_id', $anneeActive->id)
                ->with(['classe', 'anneeScolaire'])
                ->first();
        }

        return view('eleves.inscription_eleve', compact(
            'eleve',
            'anneeActive',
            'classes',
            'dejaInscrit'
        ));
    }

    //effectuer son inscription
    public function index(Request $request)
    {
        $query = inscriptions::with(['eleve', 'classe', 'anneeScolaire']);

        // Recherche par matricule de l'élève
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('eleve', function ($q) use ($search) {
                $q->where('matricule', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%");
            });
        }

        // Filtrer par classe
        if ($request->filled('classe_id')) {
            $query->where('id_classe', $request->classe_id);
        }

        // Filtrer par année scolaire
        if ($request->filled('annee_scolaire_id')) {
            $query->where('annee_scolaire_id', $request->annee_scolaire_id);
        }

        // Filtrer par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $inscriptions   = $query->orderBy('date_inscription', 'desc')->paginate(15);
        $classes        = Classes::all();
        $anneesScolaires = AnneeScolaire::orderBy('libelle', 'desc')->get();

        return view('inscriptions.index', compact('inscriptions', 'classes', 'anneesScolaires'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $eleves          = Eleves::orderBy('nom')->get();
        $classes         = Classes::all();
        $anneesScolaires = AnneeScolaire::orderBy('libelle', 'desc')->get();
        $anneeActive     = AnneeScolaire::where('active', true)->first();

        return view('inscriptions.create', compact('eleves', 'classes', 'anneesScolaires', 'anneeActive'));
    }


    // effectuer son inscription côté eleves
    public function storeInscription(Request $request)
    {
        $eleve = $this->eleveConnecte();
        $anneeActive = anneeActive();

        // Vérifier si l'élève est déjà inscrit cette année
        $dejaInscrit = Inscriptions::where('id_eleve',
            $eleve->id)
            ->where('annee_scolaire_id', $anneeActive->id);

        if ($dejaInscrit) {
            return back()
                ->withInput()
                ->withErrors
                (['id_eleve' => 'Cet élève est déjà inscrit cette année.']);
        }

        // Enregistrer l'inscription
        Inscriptions::create([
            'id_eleve'          => $eleve->id,
            'id_classe'         => $request->classe_id,
            'annee_scolaire_id' => $anneeActive->id,
            'date_inscription'  => now(),
            'statut'            => 'en_attente',
        ]);
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

        // Vérifier doublon en excluant l'inscription actuelle
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
    public function destroy(Inscriptions $inscription)
    {
        $inscription->delete();

        return redirect()
            ->route('inscriptions.index')
            ->with('success', 'Inscription supprimée avec succès.');
    }
}

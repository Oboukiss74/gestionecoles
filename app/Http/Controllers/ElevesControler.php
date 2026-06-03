<?php

namespace App\Http\Controllers;

use App\Models\Eleves;
use App\Models\Parents;
use App\Models\Inscriptions;
use App\Models\Classes;
use App\Models\User;
use App\Models\EleveParent;
use Illuminate\Http\Request;

class ElevesControler extends Controller
{
    // page profile eleves
    public function profile()
    {
        return view('eleves.pages-profile');
    }
    //formaulaire d'ajout des eleves
    public function create()
    {
        $niveau = Classes::all();
        return view('eleves.ajouterEleves', compact('niveau'));
    }
    public function storeNouveauEleves(Request $request)
    {
        // dd('test');
        $validereleves = $request->validate([
            'nom'              => 'required|string',
            'prenom'           => 'required|string',
            'date_naissance'   => 'required|date',
            'lieu_naissance'   => 'required|string',
            'sexe'             => 'required|in:M,F',
            'matricule'        => 'nullable|string|unique:eleves,matricule',
            'nationalite'      => 'required|string',
            'telephone'        => 'required|string',
            'email' => 'required|email',
            // 'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nom_parent'       => 'required|string',
            'prenom_parent'       => 'required|string',
            'telephone_parent' => 'required|string',
            'residence_parent'     => 'nullable|string',
            'email_parent'     => 'required|email',
            'profession_parent'     => 'nullable|string',
            'classe_id'        => 'required|exists:classes,id',
            'parent_id'        => 'required|exists:parents,id',
            'users_id'        => 'required|exists:users,id',
            'eleve_id'        => 'required|exists:eleves,id',
            'password' => 'required|string|min:8|confirmed',
            // 'parent_id'        => 'required|exists:parents,id',
        ]);
        if ($request->hasFile('photos')) {
            $path = $request->file('photos')->store('eleves', 'public');
        } else {
            $path = null;
        }
        // dd($validereleves);
        // creer le parent
        $parent = Parents::create([
            'nom_parent' => $request->nom_parent,
            'prenom_parent' => $request->prenom_parent,
            'residence_parent' => $request->residence_parent,
            'telephone_parent' => $request->telephone_parent,
            'email_parent' => $request->email_parent,
            'profession_parent' => $request->profession_parent,
        ]);
         // ✅ Vérifier si le parent existe déjà (par téléphone)
        $parent = Parents::where('telephone_parent', $request->telephone_parent)->first();

        if (!$parent) {
            $parent = Parents::create([
                'nom_parent' => $request->nom_parent,
                'prenom_parent' => $request->prenom_parent,
                'telephone_parent' => $request->telephone_parent,
                'email_parent' => $request->email_parent,
                'residence_parent' => $request->residence_parent,
                'profession_parent' => $request->profession_parent,
            ]);
        }

        // Génération du matricule : AN-2025-00001
        $matricule = 'AN-' . date('Y') . '-' . str_pad(Eleves::count() + 1, 5, '0', STR_PAD_LEFT);
        // generer mot de passe automatiquement
        $motDePasse = genererMotDePasse();
        $password = bcrypt($motDePasse);
        // ajouter un user
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $eleve = $parent->$user->Eleves()->create([
            'parents_id' => $request->id,
            'users_id' => $user->id,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'sexe' => $request->sexe,
            'matricule' => $matricule,
            'nationalite' => $request->nationalite,
            'password' => $password,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'telephone_parent' => $request->telephone_parent,
            'photos' => $path,
            'classe_id' => $request->classe_id,
            'statut' => 'en_attente',
            'date_inscription' => now(),

        ]);
//
        // Créer l'inscription
        Inscriptions::create([
            'eleve_id'       => $eleve->id,
            'classe_id'      => $request->classe_id,
            'annee_scolaire' => anneeScolaireActuelle(),
            'statut_inscription'         => 'en_attente',
            'date_inscription' => now(),
        ]);
        // enregistrer eleve_parents
        eleve_parents::create([
            'eleve_id' => $eleve->id,
            'parent_id' => $parent->id,
        ]);

        return redirect()->route('accueil')->with('success', 'Inscription soumise avec succès !');
    }
    // enregistrer les anciens eleves
    public function storeAnciensEleves(Request $request)
    {
        $request->validate([
            'classe_id'   => 'required|exists:classes,id',
            'parents_id' => 'required|exists:parents,id',
            'users_id' => 'required|exists:users,id',
            'nom'              => 'required|string',
            'prenom'           => 'required|string',
            'date_naissance'   => 'required|date',
            'sexe'             => 'required|in:M,F',
            'matricule'        => 'nullable|string|unique:eleves,matricule',
            'nationalite'      => 'required|string',
            'telephone'        => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            // 'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nom_parent'       => 'required|string',
            'prenom_parent'       => 'required|string',
            'telephone_parent' => 'string',
            'residence_parent'     => 'nullable|string',
            'email_parent'     => 'required|email',
            'profession_parent'     => 'nullable|string',

        ]);
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('eleves', 'public');
        } else {
            $path = null;
        }

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // creer le parent
        Parents::create([
            'nom_parent' => $request->nom_parent,
            'prenom_parent' => $request->prenom_parent,
            'residence_parent' => $request->residence_parent,
            'telephone_parent' => $request->telephone_parent,
            'email_parent' => $request->email_parent,
            'profession_parent' => $request->profession_parent,
        ]);
        // 'parent_id' => $parent->id,

        // Génération du matricule : EL-2025-0001
        // $matricule = 'EL-' . date('Y') . '-' . str_pad(Eleves::count() + 1, 4, '0', STR_PAD_LEFT);
        //generer un mot de passe authomatiquement
        $motDePasse = genererMotDePasse();
        $password = bcrypt($motDePasse);

        $eleve = Eleves::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe,
            'matricule' =>$request->matricule,
            'nationalite' => $request->nationalite,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'telephone_parent' => $request->telephone_parent,
            'photo' => $path,
            'classe_id' => $request->classe_id,
            'password' => $password,
            'annee_scolaire' => anneeScolaireActuelle(),
            'statut' => 'en_attente',
            'date_inscription' => now(),
            'parent_id' => Parents::latest()->first()->id,
            
        ]);
         // enregistrer eleve_parents
        eleve_parents::create([
            'eleve_id' => $eleve_id->id,
            'parent_id' => $parent_id->id,
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
    // gestion des eleves
    public function Connexion()  {
        return view('authentification.login');
    }
    public function ListeElelves()  {
        // liste des eleves
        $eleves = Eleves::all();
        return view('eleves.listes_eleves', compact('eleves'));
    }
    //page de modification des eleves
    public function edit($id)
    {
        $eleve = Eleves::findOrFail($id);
        return view('eleves.edit_eleves', compact('eleve'));
    }
    // mettre à jour les eleves
    public function update(Request $request, $id)
    {        $eleve = Eleves::findOrFail($id);
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:M,F',
            'matricule' => 'nullable|string|unique:eleves,matricule,' . $eleve->id,
            'nationalite' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email',
            'nom_parent' => 'required|string',
            'prenom_parent' => 'required|string',
            'telephone_parent' => 'string',
            'residence_parent' => 'nullable|string',
            'email_parent' => 'required|email',
            'profession_parent' => 'nullable|string',
            'classe_id' => 'required|exists:classes,id',
        ]);
        $eleve->update($request->all());
        return redirect()->route('eleves.liste')->with('success', 'Eleve modifié avec succès !');
    }
    // supprimer les eleves
    public function destroy(Request $request, $id)
    {
        $eleve = Eleves::findOrFail($id);
        $eleve->delete();
        return redirect()->route('eleves.liste')->with('success', 'Eleve supprimé avec succès !');
    }
    // afficher les details d'un eleve
    public function show($id)
    {
        $eleve = Eleves::findOrFail($id);
        return view('eleves.details_eleves', compact('eleve'));
    }
    // afficher les eleves par année scolaire
    public function elevesParAnneeScolaire($annee)
    {
        $inscriptions = Inscriptions::with(['eleve', 'classe'])

        ->when(request('classe_id'), function ($query) {
            $query->where('classe_id', request('classe_id'));
        })
        ->when(request('annee_scolaire'), function ($query) {
        $query->where('annee_scolaire', request('annee_scolaire'));
        })
        ->get();
        return view('eleves.eleves_par_annee', compact('inscriptions'));
    }
    // afficher les eleves par classe
    public function elevesParClasse($classeId)
    {
        $inscriptions = Inscriptions::with(['eleve', 'classe'])
            ->where('classe_id', $classeId)
            ->when(request('annee_scolaire'), function ($query) {
                $query->where('annee_scolaire', request('annee_scolaire'));
            })
            ->get();
        return view('eleves.eleves_par_classe', compact('inscriptions'));
    }
}

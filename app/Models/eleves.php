<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class eleves extends Model
{
    //
    protected $fillable = [
        'classe_id',
        'parents_id',
        'users_id',
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'matricule',
        'nationalite',
        'telephone',
        'email',
        'telephone_parent',
        'photo',
    ];

    public function parent()
    {
        return $this->belongsTo(Parents::class);
    }
    public function classe()
    {
        return $this->belongsTo(Classes::class);
    }
    public function Inscription() {
        return $this->hasMany(inscriptions::class, 'eleve_id');
    }

    /**
     * Inscription de l'année scolaire en cours
     */
    public function inscriptionEnCours()
    {
        $anneeActive = AnneeScolaire::where('active', true)->first();
        return $this->inscriptions()
            ->where('annee_scolaire_id', optional($anneeActive)->id)
            ->first();
    }

}

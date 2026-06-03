<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    //
    protected $fillable = [
        'nom',
        'niveau',
        'annee',
    ];
    //relation entre les tables classes et eleves
    public function eleves()
    {
        return $this->hasMany(eleves::class);
    }
    //relation entre les tables classes et inscriptions
    public function inscriptions()
    {
        return $this->hasMany(inscriptions::class);
    }

    // classe actuelle d'un eleve
    public function classeActuelle()
    {
        return $this->inscriptions()
            ->where('annee_scolaire', anneeScolaireActuelle())
            ->where('statut', 'validee')
            ->with('classe')
            ->first();
    }

    // effectif d'une classe
    public function effectif()
    {
        return $this->inscriptions()
            ->where('annee_scolaire', anneeScolaireActuelle())
            ->where('statut', 'validee')
            ->count();
    }
}

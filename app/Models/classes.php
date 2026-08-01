<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    protected $fillable = [
        'nom',
        'niveau',
        'annee',
    ];

    public function eleves()
    {
        return $this->hasMany(eleves::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(inscriptions::class);
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'classe_matiere', 'classe_id', 'matiere_id')
            ->withTimestamps()
            ->withPivot('coefficient');
    }

    public function classeActuelle()
    {
        return $this->inscriptions()
            ->where('annee_scolaire', anneeScolaireActuelle())
            ->where('statut', 'validee')
            ->with('classe')
            ->first();
    }

    public function effectif()
    {
        return $this->inscriptions()
            ->where('annee_scolaire', anneeScolaireActuelle())
            ->where('statut', 'validee')
            ->count();
    }
    public function classeMatiere()
    {
        return $this->belongsToMany(Matiere::class, 'classe_matiere', 'classe_id', 'matiere_id')
            ->withPivot('coefficient');
    }
}

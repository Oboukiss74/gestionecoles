<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class eleve_inscriptions extends Model
{
    protected $fillable = [
        'eleve_id',
        'classe_id',
        'annee_scolaire_id',
        'statut_inscription',
        'decision',
        'date_inscription',
    ];
    //lien entre les tables eleve_inscriptions et eleves
    public function eleve()
    {
        return $this->belongsTo(eleves::class);
    }
    //lien entre les tables eleve_inscriptions et inscriptions
    public function inscription()
    {
        return $this->belongsTo(inscriptions::class);
    }
}

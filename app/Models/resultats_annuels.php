<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class resultats_annuels extends Model
{
    //
    protected $fillable = [
        'id',
        'eleve_id',
        'classe_id',
        'annee_scolaire_id',
        'moyenne_generale',
        'decision',
        'rang',
    ];
}

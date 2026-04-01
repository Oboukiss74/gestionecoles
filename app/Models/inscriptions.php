<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inscriptions extends Model
{
    //
    protected $fillable = [
        'eleve_id',
        'classe_id',
        'annee_scolaire',
        'statut',
        'date_inscription',
    ];
}

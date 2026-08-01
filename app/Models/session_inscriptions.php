<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class session_inscriptions extends Model
{
    //
    protected $fillable = [
        'libelle',
        'annee_scolaire_id',
        'date_debut',
        'date_fin',
        'statut',
        'description',
    ];
}

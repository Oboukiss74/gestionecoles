<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected $fillable = [
        'id',
        'eleve_id',
        'matiere_id',
        'annee_scolaire_id',
        'note',
    ];
}

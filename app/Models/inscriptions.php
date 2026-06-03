<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inscriptions extends Model
{
    //
    protected $fillable = [
        'eleve_id',
        'classe_id',
        'annee_scolaire_id',
        'statut_inscription',
        'date_inscription',
    ];
    public function Eleve()
    {
        return $this->belongsTo(Eleves::class, 'eleve_id');
    }
    public function Classe()
    {
        return $this->belongsTo(Classes::class, 'classe_id');
    }
}

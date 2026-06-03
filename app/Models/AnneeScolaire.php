<?php

namespace App\Models;
use App\Models\inscriptions;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    //
     protected $table = 'annee_scolaires';

    protected $fillable = [
        'libelle',  // Ex : "2024-2025"
        'active',   // true = année en cours
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function inscriptions()
    {
        return $this->hasMany(Inscriptions::class, 'annee_scolaire_id');
    }
}

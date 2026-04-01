<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class eleve_inscriptions extends Model
{
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

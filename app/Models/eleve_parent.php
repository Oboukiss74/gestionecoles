<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class eleve_parent extends Model
{
    //relation entre les tables eleve_parent et eleves
    public function eleve()
    {
        return $this->belongsTo(eleves::class);
    }
    //relation entre les tables eleve_parent et parents
    public function parent()
    {
        return $this->belongsTo(parents::class);
    }

}

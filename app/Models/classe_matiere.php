<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classe_matiere extends Model
{
    //
    protected $fillable = [
        'classe_id',
        'matiere_id',
        'coefficient',
    ];
    

}

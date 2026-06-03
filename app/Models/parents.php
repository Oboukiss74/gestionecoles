<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class parents extends Model
{
    //
    protected $fillable = [
        'nom_parent',
        'prenom_parent',
        'telephone_parent',
        'email_parent',
        'profession_parent',
        'residence_parent',
    ];
    public function Eleves()
    {
        return $this->hasMany(Eleves::class);
    }

}

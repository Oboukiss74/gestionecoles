<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $fillable = [
        'nom',
        'classe_id',
        'coefficient',
    ];

    public function classes()
    {
        return $this->belongsToMany(classes::class, 'classe_matiere', 'matiere_id', 'classe_id')
            ->withTimestamps()
            ->withPivot('coefficient');
    }

}

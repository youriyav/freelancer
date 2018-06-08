<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestataire extends Model
{
    //
    protected $attributes = [
        'adresse' => '',
        'description' => '',
        'skype' => '',
        'facebook' => '',
        'whatssap' => '',
        'nbrVueProfil' => 0,
        'endAbonnement' => '',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

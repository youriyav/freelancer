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
    public function sites()
    {
        return $this->hasMany('App\Site');
    }
    public function pictures()
    {
        return $this->hasMany('App\Photo','realisation_id');
    }
    public function slug()
    {
        return $this->hasOne('App\Slug','prestataire_id');
    }
}

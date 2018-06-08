<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function projet()
    {
        return $this->belongsTo('App\Projet');
    }
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}

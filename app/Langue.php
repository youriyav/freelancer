<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}

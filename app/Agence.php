<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    //
    public function admin()
    {
        return $this->hasOne('App\User','agency');
    }
    public function slug()
    {
        return $this->hasOne('App\Slug');
    }
}

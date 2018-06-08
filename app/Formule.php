<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formule extends Model
{
    //
    public function descriptions()
    {
        return $this->belongsToMany('App\DescriptionFormule');
    }
}

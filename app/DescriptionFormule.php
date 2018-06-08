<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DescriptionFormule extends Model
{
    //
    public function forumules()
    {
        return $this->belongsToMany('App\Formule');
    }
}

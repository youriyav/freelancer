<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
#1=agence
#2=freelance
class DescriptionFormule extends Model
{
    //
    public function forumules()
    {
        return $this->belongsToMany('App\Formule');
    }
    public function formuleDescripValue()
    {
        return $this->hasMany('App\FormuleDescriptionValue');
    }
}

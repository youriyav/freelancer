<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class plateforme extends Model
{
    private $libelle;
    //
    protected $attributes = [
        'description' => '',
        'isDeleted' => 0,
    ];
    public function technologies()
    {
        return $this->hasMany('App\Technologie');
    }
    public function logo()
    {
        return $this->hasOne('App\Photo','plateforme_id');
    }
    public function slug()
    {
        return $this->hasOne('App\Slug');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technologie extends Model
{
    protected $attributes = [
        'description' => '',
        'isDeleted' => 0,
    ];
    public function plateforme()
    {
        return $this->belongsTo('App\plateforme');
    }
    public function slug()
    {
        return $this->hasOne('App\Slug');
    }
}

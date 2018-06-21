<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    //
    protected $fillable=[
        'content',
    ];
    public function annonce()
    {
        return $this->belongsTo('App\Annonce');
    }
    public function secteur()
    {
        return $this->belongsTo('App\Secteur');
    }
    public function technologie()
    {
        return $this->belongsTo('App\Technologie');
    }
    public function plateforme()
    {
        return $this->belongsTo('App\plateforme');
    }
    public function projet()
    {
        return $this->belongsTo('App\Projet');
    }
    public function prestataire()
    {
        return $this->belongsTo('App\Prestataire');
    }
    public function agence()
    {
        return $this->belongsTo('App\Agence');
    }
}

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    #state 0=en cours de validation
    #state 1=Valider par l'admin
    #state 2=moderer par l'admin
    #state 3=cloturer par l'utisateur
    #state 4=attribuer à un freelancer
    #state 5=projet terminer
    public function plateforme()
    {
        return $this->belongsTo('App\plateforme');
    }
    public function demarrage()
    {
        return $this->belongsTo('App\DemarrageProjet','demarrage_projet_id');
    }
    public function budget()
    {
        return $this->belongsTo('App\Budget');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function freelancer()
    {
        return $this->belongsTo('App\User','freelancer_id');
    }
    public function competences()
    {
        return $this->belongsToMany('App\Technologie');
    }
    public function offres()
    {
        return $this->hasMany('App\Offre');
    }
    public function scopeToday($query)
    {
        return $query->whereRaw('Date(created_at) = CURDATE()')->get();
    }
    public function scopeState($query,$req)
    {
        return $query->whereRaw('Date(created_at) = CURDATE()')->get();
    }
    public function slug()
    {
        return $this->hasOne('App\Slug');
    }
}

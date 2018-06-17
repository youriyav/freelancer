<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','prenom', 'email', 'password',
    ];
    protected $attributes = [
        'active'=>0,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function prestataire()
    {
        return $this->hasOne('App\Prestataire');
    }
    public function validationKey()
    {
        return $this->hasMany('App\Validation');
    }
    public function profil()
    {
        return $this->hasOne('App\Photo','attached_id');
    }
    public function langues()
    {
        return $this->belongsToMany('App\Langue');
    }
    public function technologies()
    {
        return $this->belongsToMany('App\Technologie');
    }
    public function projets()
    {
        return $this->hasMany('App\Projet');
    }
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }
    public function offres()
    {
        return $this->hasMany('App\Offre');
    }

    public function sendMessage()
    {
        return $this->hasMany('App\Message','sender_id');
    }
    public function receiveMessage()
    {
        return $this->hasMany('App\Message','receiver_id');
    }

    public function commandes()
    {
        return $this->hasMany('App\Commande');
    }
    public function agence()
    {
        return $this->belongsTo('App\Agence','agency');
    }
}

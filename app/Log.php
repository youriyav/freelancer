<?php

namespace App;
# 1=création compte
# 2=connexion
# 3=déconnexion
# 4=nouveau projet
# 5=nouvelle offre
# 6=nouveau message
# 7=vue profil
# 8=mise à jour profil
# 9=bad authentification
# 10=bad authentification
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $attributes = [
        'state' => 0,
    ];
}

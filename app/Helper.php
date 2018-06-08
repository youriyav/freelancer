<?php

use App\Offre;
use App\Projet;
use Carbon\Carbon;
/**
 * Created by PhpStorm.
 * User: youri
 * Date: 16/04/2018
 * Time: 17:16
 */

function getDureeFromCarbone($carbone)
{
    $duree=(Carbon::now()->diffInMinutes($carbone)); // 0);
    if($duree<1)
    {
        return "à l'instant";
    }
    if($duree>1 && $duree<60)
    {
        return " il y'a ".$duree.' min';
    }
    if($duree>60 && $duree<1440)
    {
        return " il y'a ".round($duree/60).' heure (s)';
    }
    if($duree>1440 && $duree<43200)
    {
        return " il y'a ".round($duree/1440).' jour (s)';
    }
    return $duree;
}


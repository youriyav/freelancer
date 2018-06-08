<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $attributes = [
        'isReaded' => 0
    ];
    public function membre()
    {
        return $this->belongsTo('App\User');
    }
}

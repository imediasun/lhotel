<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    public function photos(){

        return $this->hasMany('App\Photo','id_room');
    }
    
}

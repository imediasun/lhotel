<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function goods(){

        return $this->hasMany('App\Good','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function user(){
        return $this->hasMany(User::class);
    }
}

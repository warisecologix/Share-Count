<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function stock(){
        return $this->belongsTo(Stock::class);
    }
}

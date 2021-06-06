<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'no_shares_own',
        'country_list',
        'brokage_name',
        'date_purchase'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}

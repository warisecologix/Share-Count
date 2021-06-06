<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::insert([
        [
            'name'=>'Pakistan',
        ],
        [
            'name'=>'Turkey',
        ],
        [
            'name'=>'USA',
        ]
    ]);
    }
}

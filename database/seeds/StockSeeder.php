<?php

use App\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::insert([
            [
                'name'=>'GME',
            ],
            [
                'name'=>'AMC',
            ]
        ]);
    }
}

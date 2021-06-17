<?php

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
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 1000; $i++) {
            \Illuminate\Support\Facades\DB::table('stocks')->insert([
                'company_id' => rand(1,2),
                'user_id' => rand(1 , 100),
                'no_shares_own' =>rand(1,50),
                'country_list' => rand(1,50),
                'brokage_name' => $faker->name,
                'date_purchase' => $faker->date(),
                'stock_verified' => rand(0,1),
                'admin_verify' => rand(0,1),
                'verified_string' => $faker->text,
                'created_at' => $faker->dateTimeBetween('-5 years', now()),
                'updated_at' => $faker->dateTimeBetween('-5 years', now()),
            ]);
        }
    }
}

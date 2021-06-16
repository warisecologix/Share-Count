<?php

use Illuminate\Database\Seeder;

class UserStockLogsSeeder extends Seeder
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
            \Illuminate\Support\Facades\DB::table('user_stock_logs')->insert([
                'user_id' => rand(1, 100),
                'user_ip' => $faker->ipv6,
                'session_id' => $faker->streetAddress,
                'user_mac' => $faker->macAddress,
                'location' => $faker->address,
                'browser' => $faker->name,
                'longitude' => $faker->longitude,
                'latitude' => $faker->latitude,
                'country' => $faker->country,
                'country_code' => $faker->countryCode,
                'stock_id' => rand(1, 1000),
            ]);
        }
    }
}

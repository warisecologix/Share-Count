<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            \Illuminate\Support\Facades\DB::table('users')->insert([
                'user_name' => $faker->name,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'phone_no' => $faker->unique()->phoneNumber,
                'phone_code' => $faker->countryCode,
                'email_verify' => rand(0,1),
                'phone_no_verify' => rand(0,1),
                'verified_user' => rand(0,1)
            ]);
        }
    }
}

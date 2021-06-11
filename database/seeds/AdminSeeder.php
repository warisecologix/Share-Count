<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::insert([
            [
                'name'=>'Admin User',
                'email'=>'admin@gmail.com',
                'password'=> \Illuminate\Support\Facades\Hash::make('password'),
            ]
        ]);
    }
}

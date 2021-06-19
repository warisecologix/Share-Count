<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            CompanySeeder::class,
            UserSeeder::class,
            StockSeeder::class,
            UserStockLogsSeeder::class
        ]);
    }
}

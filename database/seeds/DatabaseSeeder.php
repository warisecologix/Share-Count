<?php

use App\Stock;
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
            CompanySeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            StockSeeder::class,
            UserStockLogsSeeder::class,
        ]);
    }
}

<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::insert([
            [
                'company_name'=>'GME',
            ],
            [
                'company_name'=>'AMC',
            ]
        ]);
    }
}

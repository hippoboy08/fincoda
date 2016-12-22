<?php

use Illuminate\Database\Seeder;

class CompanyProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Company_Profile::create([
            'company_id'=>'1',
            'type'=>'education',
            'country'=>'Country',
            'city'=>'Turku',
            'street'=>'joukahaisenkatu',
            'email'=>'fincoda@corporation.com',
            'phone'=>'234556678',
            'postcode'=>'20567'

        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name'=>'Fincoda Corporation',
            'company_code'=>'FINCODA_skdjfksjd123',
            'slug'=>'fincoda_corporation'
        ]);
    }
}

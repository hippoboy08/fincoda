<?php

use Illuminate\Database\Seeder;
use App\Indicator_Group;

class IndicatorGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Indicator_Group::create([
            'name'=>'individual',
            ]);
        Indicator_Group::create([
           'name'=>'interpersonal'
        ]);
        Indicator_Group::create([
           'name'=>'networking'
        ]);
    }
}

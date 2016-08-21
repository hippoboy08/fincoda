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
        DB::table('indicator_groups')->insert([
            'name' => 'CREATIVITY',
                    ]);
        DB::table('indicator_groups')->insert([
            'name' => 'CRITICAL THINKING',

        ]);
        DB::table('indicator_groups')->insert([
            'name' => 'INITIATIVE',

        ]);
        DB::table('indicator_groups')->insert([
            'name' => 'TEAMWORK',

        ]);
        DB::table('indicator_groups')->insert([
            'name' => 'NETWORKING',

        ]);
    }
}

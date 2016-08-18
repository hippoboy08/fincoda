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
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('indicator_groups')->insert([
            'name' => 'CRITICAL THINKING',
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('indicator_groups')->insert([
            'name' => 'INITIATIVE',
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('indicator_groups')->insert([
            'name' => 'TEAMWORK',
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('indicator_groups')->insert([
            'name' => 'NETWORKING',
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class SurveyCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Survey_Category::create([
            'name'=>'Company Survey'
        ]);

        \App\Survey_Category::create([
            'name'=>'Group Survey'
        ]);
    }
}

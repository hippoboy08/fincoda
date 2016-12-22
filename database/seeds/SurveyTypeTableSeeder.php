<?php

use Illuminate\Database\Seeder;
use App\Survey_Type;
class SurveyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Survey_Type::create([
            'name'=>'self survey',
             ]);
        Survey_Type::create([
            'name'=>'peer survey',
        ]);
    }
}

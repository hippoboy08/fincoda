<?php

use Illuminate\Database\Seeder;
use App\User_Profile;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User_Profile::create([
        'user_id'=>1,
        'gender'=>'male'
    ]);
        User_Profile::create([
            'user_id'=>2,
            'gender'=>'male'
        ]);
        User_Profile::create([
            'user_id'=>3,
            'gender'=>'male'
        ]);
    }
}

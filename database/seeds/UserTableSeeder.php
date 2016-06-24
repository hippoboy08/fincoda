<?php

use Illuminate\Database\Seeder;
use App\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(App\User::class)->create([
        'name'=>'admin',
        'email'=>'admin@fincoda.com',
        'password'=>bcrypt('password'),
        'company_id'=>1
       ])->roles()->attach(1);

        factory(App\User::class)->create([
            'name'=>'special',
            'email'=>'special@fincoda.com',
            'password'=>bcrypt('password'),
            'company_id'=>1
        ])->roles()->attach(2);

        factory(App\User::class)->create([
            'name'=>'basic',
            'email'=>'basic@fincoda.com',
            'password'=>bcrypt('password'),
            'company_id'=>1
        ])->roles()->attach(3);


    }
}

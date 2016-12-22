<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'=>'admin',
            'display_name'=>'admin',
            'description'=>'An Admin role.'
        ]);
        DB::table('roles')->insert([
            'name'=>'special',
            'display_name'=>'special',
            'description'=>'Special user role.'
        ]);
        DB::table('roles')->insert([
            'name'=>'basic',
            'display_name'=>'basic',
            'description'=>'basic user role.'
        ]);

    }
}

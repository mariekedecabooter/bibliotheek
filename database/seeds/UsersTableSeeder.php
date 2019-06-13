<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'role_id'=>1,
            'address_id'=>1,
            'is_active'=>1,
            'name'=>'marieke',
            'last_name'=>'decabooter',
            'rijksregisternummer' => '111111111',
            'email'=>'marieke.decabooter@gmail.com',
            'password'=>bcrypt(123456),
            'remember_token'=>str_random(10)
        ]);
        factory('App\User',9)->create();
    }
}

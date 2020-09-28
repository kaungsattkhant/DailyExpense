<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\User::create([
            'name'=>'Testing',
            'email'=>'testing@gmail.com',
            'password'=>bcrypt('password'),
        ]);
        \App\Model\User::create([
            'name'=>'Mg Kaung',
            'email'=>'mgkaung@gmail.com',
            'password'=>bcrypt('password'),
        ]);
    }
}

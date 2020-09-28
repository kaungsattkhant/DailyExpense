<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Customer::create([
            'name'=>'Testing Customer',
            'email'=>'testing_customer@gmail.com',
            'phone_number'=>'092544849',
            'address'=>'Yangon',
        ]);
        \App\Model\Customer::create([
            'name'=>'New Customer',
            'email'=>'new_customer@gmail.com',
            'phone_number'=>'0949948849',
            'address'=>'Mandalay',
        ]);
    }
}

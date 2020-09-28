<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products=['Mobile Phone','Computer','Camera','Earphone'];
        foreach($products as $p){
            \App\Model\Product::create([
                'name'=>$p,
                'category_id'=>1,
                'remain_qty'=>40,
                'price'=>11000
            ]);
        }
    }
}

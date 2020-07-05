<?php

use Illuminate\Database\Seeder;

class ProductsImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('image_products')->delete();
        \Illuminate\Support\Facades\DB::table('products')->delete();

        factory(\App\Product::class,16)->create()->each(function ($p){
            $p->imageProduct()->saveMany(factory(App\ImageProduct::class,rand(3,5))->make());
        });

        \App\Product::all()->each(function ($p){
           $ip = $p->imageProduct()->first();
            $ip->is_main_img = '1';
            $ip->save();
        });
    }
}

<?php

use Illuminate\Database\Seeder;

class RatesProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = \App\User::all();
        $number_of_users = count($users);


        foreach (\App\Product::all() as $product){
            foreach ($users as $user){
                $user->rateProduct($product,rand(1,5));
            }
        }
    }
}

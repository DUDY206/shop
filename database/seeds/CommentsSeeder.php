<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\Comment;
class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $users = User::all();
        $number_of_users = count($users);

        $products = Product::all();
        $number_of_products = count($products);

//        foreach ($users as $user){
//            foreach ($products as $product){
//                $number_of_commnents = rand(1,3);
//                for ($i=0;$i<$number_of_commnents;$i++){
//                    $user->commentProduct($product,$faker->text);
//                }
//            }
//        }

        $commentProducts = Comment::where('reply_type','App\Product')->get();
        foreach ($commentProducts as $commentProduct){
            foreach ($users as $user){
                $reply = (rand(0,1) == 1);
                if($reply){
                    $user->commentComment($commentProduct,$faker->text);
                }
            }
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Comment;
class LikeCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $comments = Comment::all();
        foreach ($comments as $comment){
            foreach ($users as $user){
                $action = (rand(1,4) == 1);
                if($action){
                    $like = (rand(0,1) == 1) ? 1: -1;
                    $user->rateComment($comment,$like);
                }
            }
        }
    }
}

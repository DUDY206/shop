<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class LikeCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Comment $comment)
    {
        $rate = (int) request()->rate;

        auth()->user()->rateComment($comment,$rate);

        $totalLike = $comment->like_count;
        $totalDislike = $comment->dislike_count;


    }
}

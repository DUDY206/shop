<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Product;
use Illuminate\Http\Request;

class CommentProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        return Product::find($product_id)->comments()->orderBy('created_at','DESC')->simplePaginate(3);
    }
    public function showReply($cid){
        return Comment::find($cid)->replyComments()->orderBy('created_at','DESC')->simplePaginate(3);;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $comment = Comment::create($request->validate(['body'=>'required'])+['reply_id'=>$request->reply_id,'reply_type'=>$request->reply_type,'user_id'=>$request->user_id]);
        if($request->expectsJson()){
            return response()->json([
                'message' =>'Your answer has been submmited successfully',
                'comment' => $comment,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

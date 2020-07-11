<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function rate_product($product_id,Request $request)
    {
        $product = Product::find($product_id);
        User::find(Auth::id())->rateProduct($product,$request->rate_value);
        if($request->expectsJson()){
            return response()->json([
                'message' =>'Your have been rate this product successfully',
            ]);
        }
    }

    public function get_rate_product($product_id){
        $rate = DB::table('rates')->where([
            ['user_id',Auth::id()],
            ['rate_type',Product::class],
            ['rate_id',$product_id]])->sum('rate');

        return $rate;

    }
}

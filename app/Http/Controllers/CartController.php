<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\User;
use DB;
use App\Product;
use App\Bill;
use App\BillDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listBill = User::find(Auth::id())->bills;

        return view('bill_status',compact(['listBill']));
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
     * @return Request
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $listProductSelected = ($request->listProductSelected);
            $bill = Bill::create([
                'user_sale_id' => $request->user_sale_id,
                'user_created_id' => Auth::id(),
                'customer_name' => $request->customer_name,
                'customer_phonenumber' => $request->customer_phonenumber,
                'customer_address' => $request->customer_address,
                'sale_value' => $request->sale_value,
            ]);
            foreach ($listProductSelected as $product){
                $product = (object)$product;
                BillDetails::create([
                    'bill_id' => $bill->id,
                    'product_id' =>$product->id,
                    'quantity' => $product->quantity_selected,
                    'price' => $product->price_out
                ]);
                Product::find($product->id)->decrement('quantity',$product->quantity_selected);
            }

            DB::commit();
        }catch (\Exception $ex){
            DB::rollback();
        }

        if($request->expectsJson()){
            return response()->json([
                'message' =>'Your bill request have been send successfully! Please wait for our contact',
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

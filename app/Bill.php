<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

class Bill extends Model
{
    protected $table = 'bills';
    protected $fillable = ['user_sale_id','user_created_id','customer_name','customer_phonenumber','customer_address','sale_value'];
    protected $appends = ['total_price','text_status','details_bill'];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function detail(){
        return $this->hasMany(BillDetails::class,'bill_id','id');
    }
    public function getTotalPriceAttribute(){
        $list_details = $this->detail;
        $total = 0;
        foreach ($list_details as $list_detail){
            $price = Product::find($list_detail->product_id)->price_out;
            $total += $list_detail->quantity * $price;
        }
        return $total;
    }
    public function getTextStatusAttribute(){
        switch ($this->status){
            case 0:{
                return "Confirming";
            };
            case 1:{
                return "Confirmed";
            };
            case 2:{
                return "Delivering";
            };
            case 3:{
                return "Received";
            };
            case 4:{
                return "Successfully";
            };
            case 5:{
                return "Returned";
            };
        }
    }

    public function getDetailsBillAttribute(){
        $list_details = $this->detail;;
        foreach ($list_details as $list_detail){
            $name = Product::find($list_detail->product_id)->name;
            $list_detail['product_name'] = $name;
        }
        return $list_details;
    }


}

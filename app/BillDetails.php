<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetails extends Model
{
    protected $table = 'bill_details';
    protected $fillable = ['bill_id','product_id','quantity','price'];
    public function bill(){
        return $this->belongsTo(Bill::class,'bill_id','id');
    }
    public $timestamps = false;
}

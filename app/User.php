<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table ='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phonenumber','avata_src'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rateProducts(){
        return $this->morphedByMany(Product::class,'rate','')->withTimestamps();
    }
    public function rateComments(){
        return $this->morphedByMany(Comment::class,'rate')->withTimestamps();
    }
    public function rateProduct(Product $product, $rate){
        $rateProducts = $this->rateProducts();

        if($rateProducts->where('rate_id',$product->id)->exists()){
            $rateProducts->updateExistingPivot($product,['rate' => $rate]);
        }else{
            $rateProducts->attach($product,['rate' => $rate]);
        }
    }
    public function rateComment(Comment $comment,$rate){
        $rateComments = $this->rateComments();
        $existsRateComment = $rateComments->where('rate_id',$comment->id);
        if($existsRateComment->exists()){
            if ($existsRateComment->where('rate',$rate)->exists()){
                $existsRateComment->updateExistingPivot($comment,['rate' => '0']);
            }else{
                $existsRateComment->updateExistingPivot($comment,['rate' => $rate]);
            }
        }else{
            $existsRateComment->attach($comment,['rate' => $rate]);
        }
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function commentProduct(Product $product, $body){
        return $this->comments()->create(['body'=>$body,'reply_id'=>$product->id,'reply_type'=>Product::class]);
    }
    public function commentComment(Comment $comment, $body){
        return $this->comments()->create(['body'=>$body,'reply_id'=>$comment->id,'reply_type'=>Comment::class]);
    }
    public function bills(){
        return $this->hasMany(Bill::class,'user_created_id','id');
    }
}

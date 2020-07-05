<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    protected $appends = ['main_image','avg_rate'];
    protected $hidden = ['users'];
    public function imageProduct(){
        return $this->hasMany(ImageProduct::class);
    }
    public function getMainImageAttribute()
    {
        return $this->imageProduct()->where('is_main_img',1)->first()->url_img;
    }
    public function rates(){
        return $this->morphToMany(User::class,'rate')->withTimestamps();
    }
    public function comments(){
        return $this->morphMany(Comment::class,'reply')->orderBy('created_at','DESC');
    }
    public function getAvgRateAttribute(){
        return $this->rates()->avg('rate');
    }

}

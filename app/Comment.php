<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['body','reply_id','reply_type','user_id'];
    protected $appends = ['user_name','user_avatar','created_date','like_count','dislike_count'];
    protected $hidden = ['user'];
    public function user(){
        return $this->belongsTo(User::class);
    }
//    public function product(){
//        return $this->belongsTo(Product::class);
//    }
    public function rates(){
        return $this->morphToMany(User::class,'rate','rates','','','','','')->withTimestamps();
    }
    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
    public function belong(){
        return $this->morphTo('','reply_type','reply_id');
    }
    public function replyComments(){
        return $this->morphMany(Comment::class,'reply');
    }
    public function getUserNameAttribute(){
        return $this->user->name;
    }
    public function getUserAvatarAttribute(){
        return $this->user->avata_src;
    }
    public function getLikeCountAttribute(){
        return count($this->rates()->where('rate','1')->get());
    }
    public function getDislikeCountAttribute(){
        return count($this->rates()->where('rate','-1')->get());
    }
}

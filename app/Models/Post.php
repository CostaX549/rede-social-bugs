<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = "posts";

 


    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }

    public function likedBy() {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    public function community()
{
    return $this->belongsTo(Community::class, 'community_id');
}


}

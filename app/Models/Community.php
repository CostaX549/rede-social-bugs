<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;
    protected $table  = "communitys";
      public function owner(){
          $this->belongsTo(User::class,"owner_id","id");
      }
    public function users(){
        return $this->belongsToMany(User::class, 'members', 'community_id', 'user_id');
    }

    public function posts()
{
    return $this->hasMany(Post::class);
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['type','post_id','message','user_id'];

     //user
     public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }

    //post
    public function post():BelongsTo{
        return $this->belongsTo(Post::class,'post_id');
    }
}

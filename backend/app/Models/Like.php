<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','post_id'];


    //post
    public function post():BelongsTo{
        return $this->belongsTo(Post::class,'post_id');
    }
    //user
    public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }
    //Like and unlike on post
   public static function store($request){
     $like = self::where('user_id',$request->user()->id)->where('post_id',$request->post_id)->first();
     if($like){
         $like->delete();
         return false;
     }else{
         self::create([
             'user_id' => $request->user()->id,
             'post_id' => $request->post_id,
         ]);
         return true;
     }
   }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','post_id','text'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }

    public static function list(){
        return self::all();
    }

    //creat or update a comment
    public static function store($request, $id = null)
    {
        // Get the authenticated user's ID
        $userId = auth()->id();
        // Add the authenticated user's ID to the data
        $data = $request->only('post_id', 'text');
        $data['user_id'] = $userId;

        // Create or update the comment
        $comment = self::updateOrCreate(['id' => $id], $data);
        return $comment;
    }
}

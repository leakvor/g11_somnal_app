<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Comment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id', 'post_id', 'text'];

    //user
    public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }

    //post
    public function post():BelongsTo{
        return $this->belongsTo(Post::class,'post_id');
    }

    //create or update comment===
    public static function store($request, $id = null)
    {
        $userId = auth()->id();
        $rules = [
            'post_id' => 'required|exists:posts,id',
            'text' => 'required|string|max:255',
        ];
        $validator = Validator::make($request->only('post_id', 'text'), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $data = $validator->validated();
        $data['user_id'] = $userId;
        return self::updateOrCreate(['id' => $id], $data);
    }

    //check user
    public function user_check()
    {
        return Auth::check() && $this->user_id == Auth::id();
    }
    //delete comment
    public static function destroy($id)
    {
        $comment = self::find($id);
        if ($comment && $comment->user_check()) {
            $comment->delete();
            return true;
        } else {
            return false;
        }
    }

}

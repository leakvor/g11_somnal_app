<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','user_id','image'];

    //user
    public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }
    //see all my post==
    public static function get_post($id){
        return Post::where('user_id',$id)->get();
    }

    //create or update post 

    public static function store($request, $id = null)
    {
        // Ensure $request is an instance of Request
        if (!$request instanceof Request) {
            $request = new Request($request);
        }

        $userId = auth()->id();
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'publish' => 'required|boolean',
            'image' => 'sometimes|file|image|max:2048',  // Optional image validation rule
        ];
        $validator = Validator::make($request->only('title', 'description', 'publish', 'image'), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data = $validator->validated();
        $data['user_id'] = $userId;

        // Use updateOrCreate to either update the existing record or create a new one
        return self::updateOrCreate(['id' => $id], $data);
    }
}

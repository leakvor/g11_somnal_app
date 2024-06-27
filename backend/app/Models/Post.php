<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    //comment
    public function comment():HasMany{
        return $this->hasMany(Comment::class,'post_id');
    }
    //like
    public function like():HasMany{
        return $this->hasMany(Like::class,'post_id');
    }
    //see all my post==
    public static function get_post($id){
        return Post::where('user_id',$id)->get();
    }

    //create or update post 
    public static function store($request, $id = null)
{
    $messages = [
        'title.required' => 'The title is required',
        'description.required' => 'The description is required',
    ];

    $validatedData = $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'description' => 'sometimes|required|string',
        'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], $messages);

    // Find the post by ID or create a new instance
    $post = self::find($id) ?? new self();

    // Ensure user_id is coming from the authenticated user
    $post->user_id = auth()->id();

    // Update only the specified columns if they are present in the request
    if ($request->has('title')) {
        $post->title = $request->title;
    }

    if ($request->has('description')) {
        $post->description = $request->description;
    }

    // Check if the request has an image
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Store the image in the storage directory
        $image->storeAs('public/uploads', $imageName);

        // Update the image field only if an image is provided in the request
        $post->image = $imageName;
    }
    $post->save();
    return $post;
}

    
    

   

    
}

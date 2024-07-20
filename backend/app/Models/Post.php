<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','user_id','company_id','status'];

    //user
    public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }
    //company
    public function company():BelongsTo{
        return $this->belongsTo(User::class,'company_id');
    }

   // items
  public function items(): HasMany
    {
        return $this->hasMany(Post_Item::class, 'post_id');
   }

    // images
   public function images(): HasMany
    {
       return $this->hasMany(Post_Image::class, 'post_id');
    }

    // public function items(): BelongsToMany
    // {
    //     return $this->belongsToMany(Item::class, 'post_items', 'post_id', 'item_id');
    // }

    // // Images relationship
    // public function images(): BelongsToMany
    // {
    //     return $this->belongsToMany(Image::class, 'post_images', 'post_id', 'image_id');
    // }


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

      // Define relationship to notifications
      public function notifications()
      {
          return $this->hasMany(Notification::class);
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
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(public_path('uploads'), $imageName);
    
            // Add the image name to the data array
            $post->image = $imageName;
        }
    
    $post->save();
    return $post;
}

    
    

   

    
}

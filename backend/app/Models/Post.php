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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Ensure user_id is coming from the authenticated user
        $data = $request->only('title', 'description');
        $data['user_id'] = auth()->id();
    
        // Check if the request has an image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Store the image in the storage directory
            $image->storeAs('public/uploads', $imageName);
    
            // Add the image name to the data array
            $data['image'] = $imageName;
        }
    
        // Create or update the post
        $post = self::updateOrCreate(['id' => $id], $data);
    
        return $post;
    }
    

   

    
}

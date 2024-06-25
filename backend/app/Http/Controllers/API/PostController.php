<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Traits\uploadImage; // Import the uploadImage trait

class PostController extends Controller
{
    use uploadImage; 

    // all post
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    // see all of my post
    public function show_post(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }
        $posts = Post::get_post($user->id);
        if ($posts->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'You haven\'t created any posts yet'], 404);
        }
        return response()->json(['success' => true, 'data' => $posts]);
    }

    // create post
    public function store(Request $request)
{
    try {
        $post = Post::store($request); 
        return response()->json([
            'post' => $post,
            'message' => $post->wasRecentlyCreated ? 'Post created successfully' : 'Post updated successfully',
        ], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 400);
    }
}

//update
public function update(Request $request, $id){
    $post=Post::find($id);
    if(!$post){
        return response()->json(['success'=>false,'message'=>'Post not found'],404);
    }
    if ($post->user_id !== auth()->id()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
    $post=Post::store($request,$id);
    return response()->json(['success'=>true,'message'=>'Post updated successfully']);
}

}

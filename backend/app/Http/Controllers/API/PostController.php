<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShowPostCommentResource;
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
        
        // Ensure user is authenticated
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Retrieve authenticated user
        $user = $request->user();

        // Retrieve all posts for the authenticated user with the 'user' relationship loaded
        $posts = Post::where('user_id', $user->id)
            ->with('user')
            ->with('like')
            ->with('comment')
            ->get();
        // If no posts found, return 404 error
        if ($posts->isEmpty()) {
            return response()->json(['message' => 'Posts not found'], 404);
        }

        // Transform each post using ShowPostCommentResource
        $transformedPosts = ShowPostCommentResource::collection($posts);

        // Return success response with transformed data
        return response()->json(['success' => true, 'data' => $transformedPosts], 200);
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
    // return $request->user()->id;
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
//destory
function destroy($id){
    $post=Post::find($id);
    if(!$post){
        return response()->json(['success'=>false,'message'=>'Post not found'],404);
    }
    if ($post->user_id!== auth()->id()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
    $post->delete();
    return response()->json(['success'=>true,'message'=>'Post has been deleted']);
}

}

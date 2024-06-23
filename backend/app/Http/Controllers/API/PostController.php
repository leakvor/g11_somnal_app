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
    use uploadImage; // Use the uploadImage trait

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
        // return $request;
        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle image upload using the uploadImage trait
        $imageName = $this->saveImage($request->file('image'), 'uploads');

        // Prepare data
        $data = $request->all();
        $data['image'] = $imageName;
        $data['user_id'] = auth()->id();

        try {
            $post = Post::create($data); // Use create instead of updateOrCreate for creating new posts
            return response()->json([
                'success' => true,
                'data' => $post,
                'message' => 'Post saved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

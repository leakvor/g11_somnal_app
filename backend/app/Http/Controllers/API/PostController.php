<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // all post
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    //see all of my post
    public function show_post(Request $request){
        $user = $request->user();   
        if(!$user){
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }   
        $posts = Post::get_post($user->id);
        if($posts->isEmpty()){
            return response()->json(['success' => false, 'message' => 'You haven\'t created any posts yet'], 404);
        }    
        return response()->json(['success' => true, 'data' => $posts]);
    }
    

}

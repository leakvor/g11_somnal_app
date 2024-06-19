<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //list all comments====
    public function index()
    {
        $comments = Comment::list();
        return response()->json(['success'=>true,'data' => $comments]);
    }
    //create comment====
    public function createComment(Request $request){
        $comment=Comment::store($request);
        return response()->json(['success'=>true,'data' => $comment,'message'=>'Create Sucessfully']);
    }
}

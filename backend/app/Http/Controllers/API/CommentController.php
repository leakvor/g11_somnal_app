<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //create a new comment====
    public function store(Request $request){
        $comment=Comment::store($request);
        return response()->json($comment);
    }
    //update comment=====
    public function update(Request $request, $id)
    {
        try {
            $userId = $request->user()->id;
            $comment = Comment::find($id);
    
            if (!$comment) {
                return response()->json(['success' => false, 'message' => 'Comment not found'], 404);
            }
            if ($comment->user_id !== $userId) {
                return response()->json(['success' => false, 'message' => "You're not the owner of this comment"], 403);
            }
            $request->validate([
                'text' => 'required|string|max:255',
            ]);
            $comment->update($request->only('text'));
    
            return response()->json(['success' => true, 'message' => 'Comment updated', 'comment' => $comment], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    //delete comment=====
    public function destroy(Request $request,$id){
       if($request->user()->id) {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['success' => false,'message' => 'Comment not found'], 404);
        }
        if ($comment->user_id!== $request->user()->id) {
            return response()->json(['success' => false,'message' => "You're not the owner of this comment"], 403);
        }
        $comment->delete();
        return response()->json(['success' => true,'message' => 'Comment deleted'], 200);
       }
    }
    

}

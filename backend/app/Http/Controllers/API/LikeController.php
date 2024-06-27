<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function user_like(Request $request){
        // return $request;
        $likeStatus = Like::store($request);
    
        if($likeStatus){
            return response()->json(['message' => 'User liked']);
        } else {
            return response()->json(['message' => 'User unliked']);
        }
    }
    
    
}

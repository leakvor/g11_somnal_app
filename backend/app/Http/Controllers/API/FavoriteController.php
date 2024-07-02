<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    //list all favs
    public function index(){
        $favs=Favorite::list();
        return response()->json(['success'=>true,'data'=>$favs]);
    }

    //create new fav
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|exists:items,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Get the authenticated user
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // Create the favorite item
        try {
            $favorite = Favorite::create([
                'user_id' => $user->id,
                'item_id' => $request->item_id,
            ]);

            return response()->json(['success' => 'Item added to favorites successfully.', 'favorite' => $favorite], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add item to favorites.', 'message' => $e->getMessage()], 500);
        }
    }
    //delete fav
    public function destroy($id){
        $favorite=Favorite::find($id);
        if(!$favorite){
            return response()->json(['success'=>false,'message'=>'Favorite not found'],404);
        }
        $favorite=Favorite::destroy($id);
        return response()->json(['success'=>true,'message'=>'Favorite has been deleted'],200);
    }

}

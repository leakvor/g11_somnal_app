<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //list items
    public function index(){
        $items= Item::list();
        return response()->json(['success'=>true,'data'=>$items]);
    }

    //create new item
    public function store(Request $request, $id = null)
    {
        // dd($request->all());
        try {
            $item = Item::store($request);
            return response()->json([
                'item' => $item,
                'message' => $item->wasRecentlyCreated ? 'Item created successfully' : 'Item updated successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    //delete item
    public function destroy($id){
        $item=Item::find($id);
        if(!$item){
            return response()->json(['success'=>false,'message'=>'Item not found'],404);
        }
        $item=Item::destroy($id);
        return response()->json(['success'=>true,'message'=>'Item deleted successfully']);
    }
    //get specific item
    public function show($id){
        $item=Item::find($id);
        if(!$item){
            return response()->json(['success'=>false,'message'=>'Item not found'],404);
        }
        $item=Item::show($item);
        $item=ItemResource::collection($item);
        return response()->json(['success'=>true,'data'=>$item]);
    }
    //update item
    public function update(Request $request, $id){
        $item=Item::find($id);
        if(!$item){
            return response()->json(['success'=>false,'message'=>'Item not found'],404);
        }
        $item=Item::store($request,$id);
        return response()->json(['success'=>true,'message'=>'Item updated successfully']);
    }
    
    // related intems
    public function getRelatedProducts($id){
        {
            // Get the item by ID
            $item = Item::findOrFail($id);
        
            $relatedItems = Item::where('category_id', $item->category_id)
                                ->where('id', '!=', $id)
                                ->get();
        
            return response()->json(['related_items' => $relatedItems]);
        }
    }
        

}

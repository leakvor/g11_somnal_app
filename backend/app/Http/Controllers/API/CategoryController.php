<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //list
    public function index(){
        $categories= Category::list();
        return response()->json(['success'=>true,'data'=>$categories]);
    }

    //create
    public function store(Request $request){
        $category=Category::store($request);
        return response()->json(['success'=>true,'message'=>'create successfully']);
    }
    //show  
    public function show($id){
        $category=Category::find($id);
        if(!$category){
            return response()->json(['success'=>false,'message'=>'Category not found'],404);
        }
        $category=Category::show($category);
        return response()->json(['success'=>true,'data'=>$category]);
    }

    //delete category
    public function destroy($id){
        $category=Category::find($id);
        if(!$category){
            return response()->json(['success'=>false,'message'=>'Category not found'],404);
        }
        $category=Category::destroy($id);
        return response()->json(['success'=>true,'message'=>'Category has been deleted'],200);
    }
    //update category
    public function update(Request $request,$id){
        // return $request;
        $category=Category::find($id);
        if(!$category){
            return response()->json(['success'=>false,'message'=>'Category not found'],404);
        }
        $category=Category::store($request,$id);
        return response()->json(['success'=>true,'message'=>'Category updated'],200);
    }


}

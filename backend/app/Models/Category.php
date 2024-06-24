<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name'];

    //list all category
    public static function list(){
        return self::all();
    }

    //create a new category
    public static function store($request,$id=null){
        $data = $request->only('name');
        $data = self::updateOrCreate(['id' => $id], $data);
    }

    //show specific category
    public static function show($id){
        $category=self::find($id);
        return $category;
    }
    //delete category
    public static function destroy($id){
        $category=self::find($id);
        $category->delete();
    }
}

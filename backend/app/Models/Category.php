<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','image'];

    public function items():HasMany{
        return $this->hasMany(Item::class);
    }
    //list all category
    public static function list(){
        return self::all();
    }

    //create a new category
    public static function store(Request $request, $id = null)
    {
        $data = $request->only('name');
    
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(public_path('scrap'), $imageName);
            $data['image'] = 'scrap' . $imageName; // Store the image path
        }
    
        return self::updateOrCreate(['id' => $id], $data);
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

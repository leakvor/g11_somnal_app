<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','image','category_id'];

    //relationship with category (one item belong to one category)
    public function category():BelongsTo{
        return $this->belongsTo(Category::class,'category_id');
    }

    //list all items
    public static function list(){
        return self::all();
    }

    //create new item
    public static function store($request, $id = null)
    {
        $messages = [
            'category_id.required' => 'No category',
            'category_id.exists' => 'Invalid category',
        ];
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);
    
        $data = $request->only('name', 'category_id');
    
        // Check if the request has an image
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(public_path('uploads'), $imageName);
    
            // Add the image name to the data array
            $data['image'] = $imageName;
        }
    
        // Create or update the item
        return self::updateOrCreate(['id' => $id], $data);
    }
    
    


    //show specific item
    public static function show($id){
        $item=self::find($id);
        return $item;
    }

    //delete item
    public static function destroy($id){
        $item=self::find($id);
        $item->delete();
    }
    
  

}

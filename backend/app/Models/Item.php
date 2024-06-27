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
    protected $fillable = ['name','image','category_id','price'];

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
            'name' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'sometimes|nullable|string|max:255',
        ], $messages);
    
        // Find the item by ID or create a new instance
        $item = self::find($id) ?? new self();
    
        // Update only the specified columns if they are present in the request
        if ($request->has('name')) {
            $item->name = $request->name;
        }
    
        if ($request->has('category_id')) {
            $item->category_id = $request->category_id;
        }
    
        if ($request->has('price')) {
            $history=HistoryMarketPrice::create([
                'adjay_id' => $id,
                'old_price' => $item->price,
                'date'=>$item->created_at,
            ]);

            $item->price = $request->price;

        }
    
        // Check if the request has an image
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(public_path('uploads'), $imageName);
    
            // Add the image name to the data array
            $item->image = $imageName;
        }
    
        // Save the changes to the database
        $item->save();
    
        return $item;
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

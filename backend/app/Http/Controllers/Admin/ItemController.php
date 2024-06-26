<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HistoryMarketPrice;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:item access|category access|item create|item edit|item delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:item create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:item edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:item delete', ['only' => ['destroy']]);
        
    }

    
    public function index()
    {
        $items = Item::all();
        return view('items.index', ['items' => $items]);
    }

  

    public function create()
    {
        $categories = Category::all();
        return view('items.new', ['categories' => $categories]);
    }

    public function store(Request $request, $id = null)
{
    // dd($request->hasFile('image'));
    $validatedData = $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'category_id' => 'sometimes|required|exists:categories,id',
        'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'price' => 'sometimes|nullable|numeric',
    ]);

    // Find the item by ID or create a new instance
    $item = Item::find($id) ?? new Item();

    // Update only the specified columns if they are present in the request
    if ($request->has('name')) {
        $item->name = $request->name;
    }

    if ($request->has('category_id')) {
        $item->category_id = $request->category_id;
    }

    if ($request->has('price')) {
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

    return redirect()->route('admin.items.index')->with('success', 'Item saved successfully!');
}

    public function show($id)
    {
        //
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.items.index')->withSuccess('Item deleted !!!');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('items.edit', ['item' => $item],['categories' => $categories]);
    }

   // ItemController.php
public function update(Request $request, $id)
{
          $validatedData = $request->validate([
              'name' => 'sometimes|required|string|max:255',
              'category_id' => 'sometimes|required|exists:categories,id',
              'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
              'price' => 'sometimes|nullable|string|max:255',
          ]);
      
          // Find the item by ID or create a new instance
          $item = Item::find($id) ?? new self();
      
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
    return redirect()->route('admin.items.index')->with('success', 'Item updated successfully');
}



}

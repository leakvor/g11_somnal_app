<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:category access|category create|category edit|category delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:category create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:category edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:category delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $categories = Category::paginate(4);
        return view('category.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('category.new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $data = $request->all(); // Create an array to store the validated data
    
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(public_path('uploads'), $imageName);
    
            // Add the image name to the data array
            $data['image'] = $imageName;
        }
    
        $category = Category::create($data);
        return redirect()->route('admin.categories.index')->withSuccess('Category created !!!');
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
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->withSuccess('Category deleted !!!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        // Add more validation rules as needed
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Add image validation rule
    ]);

    $category = Category::findOrFail($id);

    // Update category data
    $category->name = $request->input('name');
    // Update other category fields as needed

    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($category->image) {
            unlink(public_path('uploads/' . $category->image));
        }

        // Upload and store the new image
        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path('uploads'), $imageName);

        // Update the category image field
        $category->image = $imageName;
    }

    $category->save();

    return redirect()->route('admin.categories.index')->withSuccess('Category updated!');
}








}

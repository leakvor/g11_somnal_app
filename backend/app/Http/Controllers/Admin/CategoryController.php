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
        $categories = Category::all();
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
            // Add more validation rules as needed
        ]);

        $category = Category::create($request->all());
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
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.categories.index')->withSuccess('Category updated!');
    }








}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category; 
use Illuminate\Pagination\Paginator;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:Company access|Company create|Company edit|Company delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Company create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Company edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Company delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $query = Company::query()->with('user', 'category'); 

        if ($request->filled('search_user')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search_user . '%');
            });
        }

        if ($request->filled('search_category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search_category . '%');
            });
        }

        $companies = $query->paginate(4); // Paginate with 4 items per page

        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        $users = User::all(); // Fetch all users
        $categories = Category::all(); 
        return view('companies.create', compact('users', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'date_work' => 'required|date',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id', 
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('company_images', 'public');
        }

       
        $data['user_id'] = $request->user_id;

        Company::create($data);

        return redirect()->route('admin.companies.index');
    }

    public function show(Company $company)
    {
        $company->load('user'); // Load the related user
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'date_work' => 'required|date',
            'image' => 'nullable|image|max:2048', 
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($company->image) {
                Storage::disk('public')->delete($company->image);
            }
            // Store new image
            $data['image'] = $request->file('image')->store('company_images', 'public');
        }

        $company->update($data);

        return redirect()->route('admin.companies.index');
    }

    public function destroy(Company $company)
    {
        if ($company->image) {
            Storage::disk('public')->delete($company->image);
        }

        $company->delete();

        return redirect()->route('admin.companies.index');
    }
}
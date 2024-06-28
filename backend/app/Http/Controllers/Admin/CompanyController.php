<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Storage; // Add this line
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\User; // Add this line

class CompanyController extends Controller
{
    public function __construct()
    {
        // Middleware setup
        $this->middleware('role_or_permission:Company access|Company create|Company edit|Company delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Company create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Company edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Company delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        $users = User::all(); // Fetch all users
        return view('companies.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'date_work' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id(); // Set the user_id

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('company_images', 'public');
        }

        Company::create($data);

        return redirect()->route('admin.companies.index')->with('success', 'Company created successfully.');
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
            'address' => 'required',
            'date_work' => 'required|date',
            'image' => 'nullable|image|max:2048', // validate image upload
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($company->image) {
                Storage::disk('public')->delete($company->image);
            }
            // Store new image
            $data['image'] = $request->file('image')->store('company_images', 'public');
        }

        $company->update($data);

        return redirect()->route('admin.companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        // Delete associated image
        if ($company->image) {
            Storage::disk('public')->delete($company->image);
        }

        $company->delete();

        return redirect()->route('admin.companies.index')->with('success', 'Company deleted successfully.');
    }
}
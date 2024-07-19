<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Revenue;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the count of users with role number 2
        $userCount = User::where('role_id', 2)->count();
    
        // Fetch the count of companies with role number 3
        $companyCount = User::where('role_id', 3)->count();
    
        // Fetch the count of categories in the category table
        $scrapCount = Category::count();
    
        // Example revenue value, replace with your actual logic
    
    
        // Dump and die the variables to debug
        // dd($revenue, $userCount, $companyCount, $scrapCount);
    
        return view('dashboard',[ 'userCount'=>$userCount, 'companyCount'=>$companyCount, 'scrapCount'=>$scrapCount]);
    }
}
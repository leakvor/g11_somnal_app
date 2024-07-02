<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RevenueController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Revenue access', ['only' => ['index', 'show']]);
    }

    public function index(){
        $revenue = Revenue::latest()->get();
        return view('revenue.index', ['revenues' => $revenue]);
    }
}


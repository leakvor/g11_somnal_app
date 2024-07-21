<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
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

    public function index()
    {
        // Fetch payments with related user and optionPaid
        $payments = Payment::with(['user', 'optionPaid'])->get();

        // Pass the payments to the view
        return view('revenue.index', compact('payments'));
    }
}


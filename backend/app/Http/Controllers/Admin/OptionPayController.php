<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OptionPayController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:OptionPaid access|OptionPaid create|OptionPaid edit|OptionPaid delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:OptionPaid create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:OptionPaid edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:OptionPaid delete', ['only' => ['destroy']]);
    }
    
}

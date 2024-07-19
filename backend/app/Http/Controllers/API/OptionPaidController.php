<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OptionPaid;
use Illuminate\Http\Request;

class OptionPaidController extends Controller
{
    //get all option
    public function index(){
        $options=OptionPaid::all();
        return response()->json(['success'=>true,'data'=>$options]);
    }
}

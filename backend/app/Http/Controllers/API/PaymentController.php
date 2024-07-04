<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Payment;
use App\Rules\Luhn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    //create new payment
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cardName' => 'required|string|max:255',
            'cardNumber' => ['required', 'string', new Luhn],
            'cvv' => 'required|string|max:3',
            'expiration_date' => 'required|string|size:5',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }
    
        $validatedData = $validator->validated();
        $validatedData['user_id'] = Auth::id(); 
        $payment = Payment::create($validatedData);
        return response()->json(['success'=>true,'message' => 'Payment created successfully', 'payment' => $payment], 201);
    }

    // list all payment
    public function index(){
        $payments = Payment::all();
        return response()->json(['success'=>true,'data'=>$payments]);
    }

    
}

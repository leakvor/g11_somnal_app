<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\User;
use App\Models\OptionPaid;
use App\Rules\Luhn;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    // Create new payment
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cardName' => 'required|string|max:255',
            'cardNumber' => ['required', 'string', new Luhn],
            'cvv' => 'required|string|max:3|regex:/^[0-9]+$/',
            'expiration_date' => 'required|string|size:5',
            'option_paid_id' => 'nullable|integer|exists:option_paids,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid request', 'fields' => $validator->messages()], 422);
        }

        $validatedData = $validator->validated();
        $validatedData['user_id'] = Auth::id();
        $validatedData['status'] = 1;

        $payment = Payment::create($validatedData);
        $payment = new PaymentResource($payment);
        return response()->json(['success' => true, 'message' => 'Payment created successfully', 'payment' => $payment], 201);
    }

    // List all payments
    public function index()
    {
        $payments = Payment::with(['user', 'optionPaid'])->get();
        return view('revenue.index', compact('payments'));
    }

// ============================get all payments ============================
public function getpayments(){
    $payments = Payment::all();
    $payments = PaymentResource::collection($payments);
    return response()->json(['success'=>true,'data'=>$payments]);

}
// ================getuserpament company payment =============================

    public function companyPayment(Request $request)
    {
        $user = $request->user();
        $companyPayment = Payment::where('user_id', $user->id)
            ->get();
    
        return response()->json([
            'success' => true,
            'message' => 'User request has a role_id of 3',
            'data' => PaymentResource::collection($companyPayment)
        ]);
    }
    
}



    // Get expiration and will be paid
    // public function createNotification()
    // {
    //     $payments = Payment::all();

    //     foreach ($payments as $payment) {
    //         $deadlineDays = 0;
    //         switch ($payment->status) {
    //             case 1:
    //                 $deadlineDays = 30;
    //                 break;
    //             case 2:
    //                 $deadlineDays = 30;
    //                 break;
    //             case 3:
    //                 $deadlineDays = 180;
    //                 break;
    //             case 4:
    //                 $deadlineDays = 365;
    //                 break;
    //             default:
    //                 continue;
    //         }

    //         $deadline = Carbon::parse($payment->created_at)->addDays($deadlineDays);
    //         $threeDaysBeforeDeadline = $deadline->subDays(3);

    //         if (Carbon::now()->gte($threeDaysBeforeDeadline) && !$payment->notificationSent) {
    //             // Create a new notification
    //             $notification = new Notification();
    //             $notification->type = 'payment_deadline';
    //             $notification->post_id = null;
    //             $notification->message = "Payment deadline approaching for payment #{$payment->id}";
    //             $notification->user_id = $payment->user_id;
    //             $notification->status = false;
    //             $notification->save();
    //             // $payment->notificationSent = true;
    //             $payment->save();
    //         }

    //         if (Carbon::now()->gte($deadline) && !$payment->isPaid()) {
    //             // Change the user role to user if payment is not made on deadline
    //             $user = User::find($payment->user_id);
    //             $user->role_id = 2;
    //             $user->save();
    //         }
    //     }
    // }

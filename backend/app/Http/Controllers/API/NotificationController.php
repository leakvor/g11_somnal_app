<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::with('post', 'company')
            ->where('status', 'pending')
            ->whereNull('post_id')
            ->get();
        $notifications = NotificationResource::collection($notifications);
        return response()->json($notifications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'notification' => 'required|string',
        //     'post_id' => 'required|integer',
        //     'company_id' => 'required|exists:companies,id',
        //     'status' => 'required|string|in:pending,sent',
        // ]);
    
        // $notification = new Notification();
        // $notification->notification = $request->input('notification');
        // $notification->post_id = $request->input('post_id');
        // $notification->company_id = $request->input('company_id');
        // $notification->status = $request->input('status');
        // $notification->save();
    
        // return response()->json(['message' => 'Notification created successfully'], 201);
        // dd($request->all()); 

        $validator = Validator::make($request->all(), [
            'notification' => 'required|string',
            'post_id' => 'required|integer',
            'company_id' => 'required|exists:companies,id',
            'status' => 'required|string|in:pending,sent',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $notification = new Notification();
            $notification->notification = $request->input('notification');
            $notification->post_id = $request->input('post_id');
            $notification->company_id = $request->input('company_id');
            $notification->status = $request->input('status');
            $notification->save();

            return response()->json(['message' => 'Notification created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create notification'], 500);
        }
    }

    public function destroy(string $id)
    {
        //
    }
}

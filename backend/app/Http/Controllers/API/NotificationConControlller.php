<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;


class NotificationConControlller extends Controller
{
    //get all notifications
    public function index()
    {
        $notification = Notification::all();
        return response()->json(['success' => true, 'data' => $notification]);
    }

    //get specific notification
    // In Notification.php
    public function company_notifications(Request $request)
    {
  
        $companyId = $request->user()->id; 
        $posts = Post::where('company_id', $companyId)->get();
        $postIds = $posts->pluck('id');
        $notifications = Notification::whereIn('post_id', $postIds)
                                     ->where('type', 'post')
                                     ->orderBy('created_at', 'desc')
                                     ->get();
        $formattedNotifications = $notifications->map(function ($notification) {
            $notification->time_diff = \Carbon\Carbon::parse($notification->created_at)->diffForHumans();
            return new NotificationResource($notification);
        }); 
    
        return response()->json(['success' => true, 'data' => $formattedNotifications]);
    }

//get user notification=================
    public function user_notification(Request $request)
{
    $userId = $request->user()->id;
    $posts = Post::where('user_id', $userId)->get();
    $postIds = $posts->pluck('id');

    $notifications = Notification::whereIn('post_id', $postIds)
                                 ->where('type', 'reply')
                                 ->orderBy('created_at', 'desc')
                                 ->get();

    $formattedNotifications = $notifications->map(function ($notification) {
        $notification->time_diff = \Carbon\Carbon::parse($notification->created_at)->diffForHumans();
        // return NotificationResource::collection($notification);
        // return $notification;
        return new NotificationResource($notification);
    });
    
    return response()->json(['success' => true, 'data' => $formattedNotifications]);
}

//company notification alert

public function company_notification_alert(Request $request)
{
    $companyId = $request->user()->id; 
    $posts = Post::where('company_id', $companyId)->get();
    $postIds = $posts->pluck('id');

    // Fetch notifications where status is false
    $notifications = Notification::whereIn('post_id', $postIds)
                                 ->where('type', 'post')
                                 ->where('status', false)
                                 ->orderBy('created_at', 'desc')
                                 ->get();

    $formattedNotifications = $notifications->map(function ($notification) {
        $notification->time_diff = \Carbon\Carbon::parse($notification->created_at)->diffForHumans();
        return new NotificationResource($notification);
    }); 

    return response()->json(['success' => true, 'data' => $formattedNotifications]);
}

//user notification alert

public function user_notification_alert(Request $request)
{
    $userId = $request->user()->id;
    $posts = Post::where('user_id', $userId)->get();
    $postIds = $posts->pluck('id');

    // Fetch notifications where status is false
    $notifications = Notification::whereIn('post_id', $postIds)
                                 ->where('type', 'reply')
                                 ->where('status', false)
                                 ->orderBy('created_at', 'desc')
                                 ->get();

    $formattedNotifications = $notifications->map(function ($notification) {
        $notification->time_diff = \Carbon\Carbon::parse($notification->created_at)->diffForHumans();
        return new NotificationResource($notification);
    });
    
    return response()->json(['success' => true, 'data' => $formattedNotifications]);
}

//mark notification as read
public function markAsSeen($id)
{
    $notification = Notification::find($id);
    if ($notification) {
        $notification->status = true;
        $notification->save();
        return response()->json(['message' => 'Notification marked as seen'], 200);
    }
    return response()->json(['message' => 'Notification not found'], 404);
}


}


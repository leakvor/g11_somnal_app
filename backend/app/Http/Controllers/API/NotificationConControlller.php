<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        // Retrieve the company ID from the authenticated user
        $companyId = $request->user()->id; // Adjust the field name as needed

        // Fetch posts with the specific company_id
        $posts = Post::where('company_id', $companyId)->get();

        // Get the IDs of the posts
        $postIds = $posts->pluck('id');

        $noti = [];
        foreach ($postIds as $postId) {
            $notifications = Notification::where('post_id', $postId)->get();
            foreach ($notifications as $notification) {
                $noti[] = $notification;
            }
        }
        // Return the notifications as a JSON response
        return response()->json(['success' => true, 'data' => $noti]);
    }

//get user notification=================
    public function user_notification(Request $request)
    {
        $userId = $request->user()->id;
        $posts = Post::where('user_id', $userId)->get();
        $postIds = $posts->pluck('id');
        $noti = [];
        foreach ($postIds as $postId) {
            $notifications = Notification::where('post_id', $postId)->where('type', 'reply')->get();
            foreach ($notifications as $notification) {
                $noti[] = $notification;
            }
        }
        return response()->json(['success' => true, 'data' => $noti]);
    }

}


<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //send chat message
    public function store(Request $request){
        try {
            $chat = Chat::store($request);
            return response()->json([
                'Chat' => $chat,
                'message' => $chat->wasRecentlyCreated ? 'Chat created successfully' : ' updated successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    //delete chat
    public function destroy($id)
{
    $result = Chat::deleteMessage($id);
    if ($result === true) {
        return response()->json(['message' => 'Message deleted successfully'], 200);
    } elseif ($result === 'Message not found') {
        return response()->json(['message' => 'Message not found'], 404);
    } else {
        return response()->json(['message' => 'You can not delete this message'], 403);
    }
}

//get messages
public function getConversation($receiverId)
{
    $conversation = Chat::getConversationWithReceiver($receiverId);

    return response()->json($conversation, 200);
}

//update message
public function updateMessage(Request $request, $id)
{
    $chat = Chat::find($id);
    if (!$chat) {
        return response()->json(['error' => 'Message not found'], 404);
    }
    if ($chat->user_id !== Auth::id()) {
        return response()->json(['error' => 'You are not the person who sent this chat.'], 403);
    }

    $request->validate([
        'message' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update message
    $chat->message = $request->input('message');

    // Update image if provided
    if ($request->hasFile('image')) {
        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path('uploads'), $imageName);
        $chat->image = $imageName;
    }

    $chat->save();

    return response()->json(['success' => true, 'message' => 'Chat updated successfully']);
}

}

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
        $chat=Chat::send_message($request);
        return response()->json(['success'=>true,'message'=>'Send chat successfully']);
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
        return response()->json(['error' => 'You are not a person who send this chat.'], 403);
    }
    $request->validate([
        'message' => 'required|string|max:255',
    ]);

    $newMessage = $request->input('message');
    $updatedChat = Chat::updateMessage($newMessage, $id);

    if ($updatedChat) {
        return response()->json($updatedChat, 200);
    } else {
        return response()->json(['error' => 'Unauthorized or message not found'], 403);
    }
}
}

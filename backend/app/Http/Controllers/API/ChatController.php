<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // list the chats
    public function listChats()
    {
        $chats = Chat::getChatsForUser();
        
        if ($chats->isEmpty()) {
            return response()->json(['error' => 'No chats found.'], 404);
        }

        return response()->json($chats);
    }
    
    // get users 
    public function getAllUsers(){
        $user = User::find(Auth::id());
        $users = User::where('id', '!=', $user->id)->get();
        return response()->json($users);
        
    }

    // get user profile 
    public function getProfile($id){
        $user = User::find($id);
        if(!$user){
            return response()->json(['error' => 'User not found.'], 404);
        }
        return response()->json($user);
    }
    

    public function getUsersWithReceiver()
    {
        // Call the model method to get the user_ids
        $userIds = Chat::getUsersWithReceiver();

        // Return the result as a JSON response
        return response()->json($userIds);
    }
        //list unseen messages
    public function listConversationIsRead()
    {
        $user = User::find(Auth::id());
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Assuming the `receiver_id` is actually `user_id` or some other correct column
        $unseenMessages = Chat::where('reciever_id', $user->id)
            ->where('is_read', 0)
            ->get();

        if ($unseenMessages->isEmpty()) {
            return response()->json([
                'Currently User' => $user->name,
                'total' => 0,
                'message' => 'You have no unseen messages.',
                'unseen_messages' => []
            ], 200);
        }

        return response()->json([
            'Currently User' => $user->name,
            'total' => $unseenMessages->count(),
            'unseen_messages' => ChatResource::collection($unseenMessages)
        ], 200);
    }
    // seen the chat
    public function seenChat(Request $request, $userId)
    {
        $user = User::find(Auth::id());
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $chats = Chat::where('reciever_id', $user->id)->where('user_id', $userId)->update(['is_read' => 1]);
        return response()->json(['success' => 'Chat seen successfully.'], 200);
        
    }
    //send chat message
    public function store(Request $request){
        try {
            $chat = Chat::store($request);
            broadcast(new MessageSent($chat))->toOthers();
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

    $conversation = ChatResource::collection($conversation);

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
        // Delete the old image file if exists
        if ($chat->image && file_exists(public_path('images/chat/' . $chat->image))) {
            unlink(public_path('images/chat/' . $chat->image));
        }

        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path('images/chat'), $imageName);
        $chat->image = $imageName;
    }

    $chat->save();

    return response()->json(['success' => true, 'message' => 'Chat updated successfully']);
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','reciever_id','message','image'];

    //user
    public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }
    //reciever
    public function reciever():BelongsTo{
        return $this->belongsTo(User::class,'reciever_id');
    }

    //send message
    public static function store($request, $id = null)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'reciever_id' => 'required|integer',
        'message' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Prepare the data array with only the necessary fields
    $data = $request->only('reciever_id', 'message');
    $data['user_id'] = auth()->id();

    // Handle the image upload if present
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/uploads', $imageName);
        $data['image'] = $imageName;
    }

    // Find the existing chat record by ID or create a new instance
    if ($id) {
        // If an ID is provided, find the record
        $chat = self::find($id);
        if (!$chat) {
            // If the chat record is not found, handle the error (e.g., throw an exception or return a response)
            abort(404, 'Chat record not found');
        }
    } else {
        // If no ID is provided, create a new chat instance
        $chat = new self();
    }

    // Update the chat record with the provided data
    $chat->fill($data);

    // Save the changes to the database
    $chat->save();

    return $chat;
}

    

    //delete message
    public static function deleteMessage($id)
    {
        $chat = self::find($id);
        if (!$chat) {
            return 'Message not found';
        }
        if (Auth::id() !== $chat->user_id) {
            return 'You are not allowed to delete this message';
        }
        $chat->delete();
        return true;
    }
    //get message
    public static function getConversationWithReceiver($receiverId)
    {
        $userId = Auth::id();
        return self::where(function($query) use ($userId, $receiverId) {
            $query->where('user_id', $userId)
                  ->where('reciever_id', $receiverId);
        })->orWhere(function($query) use ($userId, $receiverId) {
            $query->where('user_id', $receiverId)
                  ->where('reciever_id', $userId);
        })->orderBy('created_at', 'asc')->get();
    }

    //update message of chat
    public static function updateMessage($newMessage,$id )
    {
        $chat = self::find($id);
        if ($chat && $chat->user_id === Auth::id()) {
            $chat->message = $newMessage;
            $chat->save();
            return $chat;
        }
        return null;
    }
}

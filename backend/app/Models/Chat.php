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
    protected $fillable = ['user_id','reciever_id','message'];

    //user
    public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }
    //reciever
    public function reciever():BelongsTo{
        return $this->belongsTo(User::class,'reciever_id');
    }

    //send message
    public static function send_message($request){
        $chat = new Chat();
        $chat->user_id = $request->user()->id;
        $chat->reciever_id = $request->reciever_id;
        $chat->message = $request->message;
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

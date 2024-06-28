<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Favorite extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id', 'item_id'];
    //relationship of user
    public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }

    //relationship with item
    public function item():BelongsTo{
        return $this->belongsTo(Item::class,'item_id');
    }

    //list all favorite items
    public static function list($user_id){
        return self::where('user_id',$user_id)->get();
    }

    //add favorite item
    public static function store($request)
    {
    }

    //delete from favorites list
    public static function destory($id)
    {
        $fav = self::find($id);    
        if ($fav && $fav->user_id == Auth::id()) {
            $fav->delete();
            return response()->json(['success' => 'Favorite item deleted successfully.'], 200);
        }
        return response()->json(['error' => 'Unauthorized or favorite item not found.'], 403);
    }

}

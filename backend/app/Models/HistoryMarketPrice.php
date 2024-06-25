<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryMarketPrice extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['adjay_id','old_price','date'];

    public function adjay(){
        return $this->belongsTo(Item::class,'adjay_id');
    }

    //list all history
    public static function list(){
        return self::all();
    }

    //delete history
    public static function destory($id){
        $history=self::find($id);
        $history->delete();
    }

   
   
}

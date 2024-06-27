<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketofAdjay extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['adjay_id','price'];

    //relationship adjay
    public function adjay():BelongsTo{
        return $this->belongsTo(Adjay::class,'adjay_id');
    }
    //store
    public static function store($request, $id = null)
    {
        $data = $request->only('adjay_id', 'price');

        // Debugging line
        \Log::info('Data to be saved: ', $data);

        $marketofAdjay = self::updateOrCreate(['id' => $id], $data);

        // Debugging line
        \Log::info('Saved data: ', $marketofAdjay->toArray());

        return $marketofAdjay;
    }

    //show market price adjay
    public static function show($id){
        $adjay=self::find($id);
        return $adjay;
    }
  //delete
  public static function destory($id){
    $market_price=self::find($id);
    $market_price->delete();
  }
    


}

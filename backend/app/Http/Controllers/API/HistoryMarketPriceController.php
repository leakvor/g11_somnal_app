<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryMarketPrice;
use Illuminate\Http\Request;

class HistoryMarketPriceController extends Controller
{
    //list all history
    public function index(){
        $history=HistoryMarketPrice::list();
        return response()->json(['success'=>true,'data'=>$history]);
    }

    //delete specific history
    public function destroy($id){
        $history=HistoryMarketPrice::find($id);
        if(!$history){
            return response()->json(['success'=>false,'message'=>'History not found'],404);
        }
        $history=HistoryMarketPrice::destory($id);
        return response()->json(['success'=>true,'message'=>'History has been deleted'],200);
    }

}
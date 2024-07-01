<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryMarketPrice;
use App\Models\Item;
use Illuminate\Http\Request;

class HistoryMarketprices extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:history access|history delete|history access', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:history delete', ['only' => ['destroy']]);

    }

    public function index()
    {
        $histories = HistoryMarketPrice::paginate(4);
        $items=Item::all();
        return view('history.index', ['histories' => $histories],['items' => $items]);
    }


}

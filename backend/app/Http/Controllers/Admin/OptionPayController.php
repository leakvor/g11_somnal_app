<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionPaid;
use Illuminate\Http\Request;

class OptionPayController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:OptionPaid access|OptionPaid create|OptionPaid edit|OptionPaid delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:OptionPaid create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:OptionPaid edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:OptionPaid delete', ['only' => ['destroy']]);
    }

    //get all option paid
    public function index()
    {
        $optionPaids =OptionPaid::paginate(4);
        return view('optionPaid.index', ['optionPaids' => $optionPaids]);
    }

    //page create
    public function create(){
        return view('optionPaid.new');
    }

    //store new option paid
    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'option_paid' => 'nullable|string|max:255',
        'amount' => 'nullable|integer',
        'description' => 'nullable|string|max:255', 
        'type' => 'nullable|string|max:255', 
    ]);

    // Create a new OptionPaid record
    OptionPaid::create($request->only('option_paid', 'amount', 'description','type'));

    return redirect()->route('admin.optionPaid.index')->with('success', 'Option Paid created successfully');
}

    

    //edit option
    public function edit($id){
        $optionPaid = OptionPaid::find($id);
        return view('optionPaid.edit', ['optionPaid' => $optionPaid]);
    }

    //update option paid
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'option_paid' => 'nullable|string|max:255',
            'amount' => 'nullable|integer',
            'description' => 'nullable|string|max:255', 
            'type' => 'nullable|string|max:255', 
        ]);
    
        // Find the OptionPaid record
        $optionPaid = OptionPaid::find($id);
    
        if (!$optionPaid) {
            return redirect()->route('admin.optionPaid.index')->with('error', 'Option Paid not found');
        }
    
        // Update the OptionPaid record
        $optionPaid->update($request->only('option_paid', 'amount', 'description','type'));
    
        return redirect()->route('admin.optionPaid.index')->with('success', 'Option Paid updated successfully');
    }
    

    //delete option
    public function destroy($id)
    {
        $category = OptionPaid::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.optionPaid.index')->withSuccess('Category deleted !!!');
    }

}

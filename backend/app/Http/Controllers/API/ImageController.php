<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //upload image
    function UploadImage(Request $request){
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            return $name;
        }
        return 'No image found';
    }
}

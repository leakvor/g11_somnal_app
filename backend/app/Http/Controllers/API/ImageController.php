<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
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

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the image record
        $image = Image::find($id);

        if (!$image) {
            return response()->json(['error' => 'Image not found'], 404);
        }

        // Check if a new image was uploaded
        if ($request->hasFile('image')) {

            // Upload the new image
            $newImage = $request->file('image');
            $name = uniqid() . '.' . $newImage->getClientOriginalExtension();
            $destinationPath = public_path('uploads');
            $newImage->move($destinationPath, $name);

            // Update the image path in the database
            $image->image = $name;
            $image->save();
        }

        return response()->json(['message' => 'Image updated successfully', 'image' => $image]);
    }
}

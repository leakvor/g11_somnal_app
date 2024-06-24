<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ImageController extends Controller
{
    public function imageUpload(Request $request) {
        // dd($request->all());
        return $request;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName, 'public');

            return response()->json([
                'message' => 'File uploaded successfully',
                'file_name' => $fileName
            ], 200);
        } else {
            return response()->json([
                'message' => 'No file uploaded'
            ], 400);
        }
    }
}

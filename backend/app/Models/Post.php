<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','user_id','image'];

    //user
    public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }
    //see all my post==
    public static function get_post($id){
        return Post::where('user_id',$id)->get();
    }

    //create or update post 

   

    private function saveImage($file, $directory)
    {
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $imageName);
        return $imageName;
    }
}

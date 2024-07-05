<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post_Image extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['post_id', 'image_id'];

    public function image():BelongsTo{
        return $this->belongsTo(Image::class,'image_id');
    }

    public function post():BelongsTo{
        return $this->belongsTo(Post::class,'post_id');
    }
}

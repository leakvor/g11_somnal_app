<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post_Item extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['post_id', 'item_id'];

    public function item():BelongsTo{
        return $this->belongsTo(Item::class,'item_id');
    }

    public function post():BelongsTo{
        return $this->belongsTo(Post::class,'post_id');
    }
}

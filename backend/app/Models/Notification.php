<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['notification', 'post_id', 'company_id', 'status'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['type','post_id','message','user_id'];

     //user
     public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }

    //post
    public function post():BelongsTo{
        return $this->belongsTo(Post::class,'post_id');
>>>>>>> 7b782fa621c0a7aafcd98d92622398efdd86fbd8
    }
}

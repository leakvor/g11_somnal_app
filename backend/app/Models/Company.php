<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'user_id',
        'name',
        'phone',
        'email',
        'address',
        'date_work',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
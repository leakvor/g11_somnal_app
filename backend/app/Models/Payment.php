<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'cardName',
        'cardNumber',
        'cvv',
        'expiration_date',
        'user_id',
    ];

    // Relationship with user
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
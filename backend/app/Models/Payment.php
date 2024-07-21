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
        'price',
        'option_paid_id',
        'status',
    ];

    // Relationship with user
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    //Relationship with option paid
    public function optionPaid(): BelongsTo
    {
        return $this->belongsTo(OptionPaid::class, 'option_paid_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Casts\MoneyCast;

class Member extends Model
{
    use HasFactory;
    protected $casts = [
        'deduction_ammount' => MoneyCast::class,
        'effective_date' => 'datetime',
    ];

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Installment extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'amount' => MoneyCast::class,
    ];

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }
}

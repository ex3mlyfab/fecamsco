<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoanProduct extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'total_cost' => MoneyCast::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function loan() :BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function loanProductDetails(): HasMany
    {
        return $this->hasMany(LoanProductDetail::class);
    }
}

<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class BankMandateDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $cast = [
        'amount' => MoneyCast::class,
    ];
    public function bankMandate(): BelongsTo
    {
        return $this->belongsTo(BankMandate::class);
    }
    public function mandateable(): MorphTo
    {
        return $this->morphTo();
    }
}

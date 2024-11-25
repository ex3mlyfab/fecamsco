<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavingUpload extends Model
{
    use HasFactory;
    protected $casts = [
        'deduction_amount' => MoneyCast::class,
    ];

    protected $guarded = [];

    public function SavingUploadDetail(): BelongsTo
    {
        return $this->belongsTo(SavingUploadDetail::class);
    }
}

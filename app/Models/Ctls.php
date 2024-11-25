<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ctls extends Model
{
    use HasFactory;
    protected $casts = [
        'deduction_amount' => MoneyCast::class,
    ];

    protected $guarded = [];

    public function ctlsDetail(): BelongsTo
    {
        return $this->belongsTo(CtlsDetails::class, 'ctls_detail_id');
    }


}

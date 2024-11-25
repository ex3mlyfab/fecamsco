<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplierPayment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'amount' => MoneyCast::class
    ];
    public function supplier():BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function receiveOrder(): BelongsTo
    {
        return $this->belongsTo(ReceiveOrder::class);
    }
}

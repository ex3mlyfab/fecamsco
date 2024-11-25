<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReceiveOrder extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'cost' => MoneyCast::class
    ];
    public function productReceiveds():HasMany
    {
        return $this->hasMany(ProductReceived::class)->latest();
    }
    public function receiveOrderDetails(): HasMany
    {
        return $this->hasMany(ReceiveOrderDetail::class);
    }

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}

<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceiveOrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'price' => MoneyCast::class
    ];

    public function ProductService(): BelongsTo
    {
        return $this->belongsTo(ProductService::class);
    }
}

<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'price' => MoneyCast::class
    ];

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    function productService() : BelongsTo {
        return $this->belongsTo(ProductService::class);
    }
}

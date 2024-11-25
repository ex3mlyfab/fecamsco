<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReturn extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'selling_price' => MoneyCast::class
    ];

    public function productService() : BelongsTo {
        return $this->belongsTo(ProductService::class);
    }
}

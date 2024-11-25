<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'Total_cost' => MoneyCast::class,
    ];

    public function productSales(): HasMany
    {
        return $this->hasMany(ProductSale::class, 'Sale_id');
    }
}

<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductService extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function productServiceCategory(): BelongsTo
    {
        return $this->belongsTo(ProductServiceCategory::class, 'product_service_id');
    }

    public function productReceiveds() : HasMany
    {
        return $this->hasMany(ProductReceived::class, 'product_service_id')->latest();
    }

    public function latestProductReceived(): HasOne
    {
        return $this->hasOne(ProductReceived::class, 'product_service_id')->latestOfMany();
    }

    public function productSales(): HasMany
    {
        return $this->hasMany(ProductSale::class)->latest();
    }
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'Sale_id');
    }
    public function productPrices(): HasMany
    {
        return $this->hasMany(ProductPrice::class)->latest();
    }

    public function productReturns(): HasMany
    {
        return $this->hasMany(ProductReturn::class)->latest();
    }

    public function getTotalReceivedAttribute()
    {
        return $this->productReceiveds()->sum('quantity_received');
    }
    public function getTotalSalesAttribute()
    {
        return $this->productSales()->sum('quantity');
    }
    public function getTotalReturnsAttribute()
    {
        return $this->productReturns()->sum('quantity');
    }
    public function getStockQuantityAttribute()
    {
        return ($this->getTotalReceivedAttribute() - $this->getTotalSalesAttribute() + $this->getTotalReturnsAttribute());
    }
    public function latestProductPrice(): HasOne
    {
        return $this->hasOne(ProductPrice::class)->latestOfMany();
    }
}

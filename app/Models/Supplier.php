<?php

namespace App\Models;

use App\Http\Livewire\RecieveOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = [];

    function purchaseOrders(): HasMany {
        return $this->hasMany(PurchaseOrder::class)->orderBy('created_at', 'desc');
    }

    public function receiveOrders():HasManyThrough
    {
        return $this->hasManyThrough(RecieveOrder::class,PurchaseOrder::class)->orderBy('created_at', 'desc');
    }

    public function supplierPayments():HasMany
    {
        return $this->hasMany(SupplierPayment::class)->orderBy('created_at', 'desc');
    }
}

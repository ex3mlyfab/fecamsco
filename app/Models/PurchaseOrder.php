<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'total' => MoneyCast::class
    ];

    public function purchaseOrderDetails(): HasMany
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }
    public function getTotalOrderCostAttribute(){
        return $this->purchaseOrderDetails();
    }
    function supplier() : BelongsTo {
        return $this->belongsTo(Supplier::class);
    }
    function createdBy() : BelongsTo {
        return $this->belongsTo(User::class, 'created_by');
    }

}

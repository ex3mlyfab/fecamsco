<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveOrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'price' => MoneyCast::class
    ];
}

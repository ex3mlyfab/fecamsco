<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $casts = [
        'amount' => MoneyCast::class,
        'approval_date' => 'datetime',
        'uploaded_date' => 'datetime',

    ];

    protected $guarded = [];
}

<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $cast = [
        'initial_balance' => MoneyCast::class,
        'current_balance' => MoneyCast::class,
    ];

}

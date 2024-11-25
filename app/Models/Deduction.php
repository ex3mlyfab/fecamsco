<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deduction extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $casts = [
        'deduction_ammount' => MoneyCast::class,
        'effective_from' => 'datetime',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

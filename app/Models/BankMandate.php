<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BankMandate extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bankMandateDetails(): HasMany
    {
        return $this->hasMany(BankMandateDetail::class)->latest();
    }
    function preparedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'prepared_by');
    }
    function approvedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'approved_by');
    }


}

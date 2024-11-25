<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CtlsDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $cast = [
        'deduction_period' => 'date',
    ];

    public function ctls() : HasMany {
        return $this->hasMany(Ctls::class, 'ctls_detail_id');
    }
    public function getCtlsUpdatedStatusAttribute()
    {
        return $this->ctls->contains(function ($row) {
            return $row['saving_linked'] == 0;
        });
    }
    public function getTotalCtlsAttribute()
    {
        return $this->ctls()->sum('deduction_amount')/100;
    }
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}

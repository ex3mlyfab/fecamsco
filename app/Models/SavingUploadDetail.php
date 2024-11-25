<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SavingUploadDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $cast = [
        'deduction_period' => 'date',
    ];

    public function savingUploads() : HasMany {
        return $this->hasMany(SavingUpload::class);
    }
    public function getSavingUpdatedStatusAttribute()
    {
        return $this->savingUploads->contains(function ($row) {
            return $row['saving_linked'] == 0;
        });
    }
    public function getTotalSavingAttribute()
    {
        return $this->savingUploads()->sum('deduction_amount')/100;
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

<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Loan extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'amount' => MoneyCast::class,
    ];
    public function installments(): HasMany{
        return $this->hasMany(Installment::class)->latest();
    }
    public function getInstallmentFulfilledAttribute(){
        $loanStatus = 0;
        if($this->installments->exists()){
           $loanStatus= $this->installments->contains(function ($row) {
                return $row['status'] == 0;
            });
        }
        return $loanStatus;
    }
    public function bankMandate(): MorphOne
    {
        return $this->morphOne(BankMandateDetail::class, 'mandateable');
    }
    public function loanProduct():HasOne
    {
        return $this->hasOne(LoanProduct::class);
    }
    public function getNextInstallmentAttribute()
    {
        return $this->installments->where('status', 0)->first();
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class);
    }
    public function loanBank(): HasOne
    {
        return $this->hasOne(LoanBank::class);
    }
    public function guarantors(): MorphMany
    {
        return $this->morphMany(Guarantor::class, 'gauranteable') ;
    }
}

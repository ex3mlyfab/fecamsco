<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LoanPlan extends Model
{
    use HasFactory;

    protected $unguarded = ['id'];

    public function instruction(): HasMany
    {
        return $this->hasMany(LoanPlanInstruction::class, 'loan_plan_id');
    }
    public function loanBank(): HasOne
    {
        return $this->hasOne(LoanBank::class);
    }
}

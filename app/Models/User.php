<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use function PHPUnit\Framework\isNull;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'last_name',
    //     'first_name',
    //     'middle_name',
    //     'email',
    //     'password',
    // ];
     protected $guarded = [];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function member(): HasOne
    {
        return $this->hasOne(Member::class);
    }
    public function guarantors(): MorphMany
    {
        return $this->morphMany(Guarantor::class, 'gauranteable') ;
    }
    public function deductions(): HasMany
    {
        return $this->hasMany(Deduction::class)->orderBy('created_at', 'desc');
    }
    public function loans():HasMany
    {
        return $this->hasMany(Loan::class)->orderBy('created_at', 'desc');
    }
    // public function scopePendingLoanPayment(Builder $query, int $amount)
    // {

    // }
    public function getCurrentDeductionAttribute(){
        return $this->deductions()->exists() ? $this->deductions->first()->deduction_amount: 0;
    }
    public function getPendingLoanPaymentAttribute(){

        return ($this->loan_status) ? $this->loans->where('status', 1)->first(function ($value, $key) {
            return $value->next_installment->status;
        }) : 0;
    }
    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class)->orderBy('created_at', 'desc');
    }
    public function getMemberStatusAttribute()
    {
        if ($this->member()->exists()) {
            return $this->member->status;
        } else {
            return 0;
        }
    }
    public function getLoanStatusAttribute(){

        $loanStatus = 0;
        if($this->loans()->exists()){
           $loanStatus= $this->loans->contains(function ($row) {
                return $row['status'] == 1 || $row['status'] == 3;
            });
        }
        return $loanStatus;
    }
    Public function getTotalContributionAttribute(){

        return $this->deposits()->sum('amount')/100;
    }

    public function getFullnameAttribute()
    {
        return $this->first_name. ' '.$this->middle_name. ' '. $this->last_name;
    }
}

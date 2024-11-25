<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanBank extends Model
{
   
    use HasFactory;
    protected $guarded = [];

    public function loan() :BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

}

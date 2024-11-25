<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Guarantor extends Model
{
    use HasFactory;
    protected $guarded =[];
  

    public function  gauranteable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

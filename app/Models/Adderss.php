<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adderss extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order(): BelongsTo{
        return $this->belongsTo(Order::class);
    }
}

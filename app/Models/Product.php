<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function product_variants(): HasMany{
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function orders(): HasMany{
        return $this->hasMany(Order::class, 'product_id');
    }
}

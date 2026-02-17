<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAttribute extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    /**
     * Get the product that owns the attribute.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

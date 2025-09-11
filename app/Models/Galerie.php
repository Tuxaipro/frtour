<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galerie extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'is_active',
        'sort_order',
        'category_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(GalerieCategory::class, 'category_id');
    }
}

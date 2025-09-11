<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GalerieCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function galeries(): HasMany
    {
        return $this->hasMany(Galerie::class, 'category_id');
    }
}

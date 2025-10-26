<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'duration_days',
        'price_from',
        'highlights',
        'tags',
        'itinerary',
        'destination_id',
        'featured_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price_from' => 'decimal:2',
        'duration_days' => 'integer',
        'sort_order' => 'integer',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}

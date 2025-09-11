<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'travel_dates',
        'number_of_travelers',
        'destinations',
        'services',
        'travel_style',
        'special_requests',
        'budget_range',
        'is_processed',
    ];

    protected $casts = [
        'travel_dates' => 'date',
        'number_of_travelers' => 'integer',
        'is_processed' => 'boolean',
    ];
}

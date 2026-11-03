<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [
        'category_id',
        'city_id',
        'name',
        'description',
        'estimated_cost',
        'provider_name',
        'contact_phone',
        'is_available',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}

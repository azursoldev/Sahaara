<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    protected $fillable = [
        'tracking_code',
        'city_id',
        'deceased_name',
        'deceased_gender',
        'contact_name',
        'contact_phone',
        'contact_relation',
        'pickup_address',
        'destination_address',
        'services_needed',
        'is_mustahiq',
        'status',
        'notes',
        'admin_remarks',
    ];

    protected $casts = [
        'services_needed' => 'array',
        'is_mustahiq' => 'boolean',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}


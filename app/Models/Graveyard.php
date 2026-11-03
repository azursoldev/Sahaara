<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Graveyard extends Model
{
    protected $fillable = [
        'city_id',
        'name',
        'address',
        'sector_or_area',
        'contact_person',
        'phone',
        'has_space',
        'map_url',
        'notes',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}

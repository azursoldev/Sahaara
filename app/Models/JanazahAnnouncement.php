<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JanazahAnnouncement extends Model
{
    protected $fillable = [
        'unique_code',
        'city_id',
        'deceased_name',
        'relation_title',
        'family_member_name',
        'contact_phone',
        'janazah_date',
        'janazah_prayer_time',
        'mosque_or_place',
        'graveyard_name',
        'additional_details',
        'views',
    ];

    protected $casts = [
        'janazah_date' => 'date',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}

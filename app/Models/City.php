<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = ['name', 'province', 'is_active'];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function graveyards(): HasMany
    {
        return $this->hasMany(Graveyard::class);
    }

    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function janazahAnnouncements(): HasMany
    {
        return $this->hasMany(JanazahAnnouncement::class);
    }
}


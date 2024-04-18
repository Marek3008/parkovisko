<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ParkingHouse extends Model
{
    use HasFactory;

    public function parkingSlots() : HasMany
    {
        return $this->hasMany(ParkingSlot::class);
    }

    public function sensors() : HasManyThrough
    {
        return $this->hasManyThrough(Sensor::class, ParkingSlot::class);
    }
}

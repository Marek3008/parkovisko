<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ParkingHouse extends Model
{
    use HasFactory;

    protected $fillable = ["name", "location","mode"];

    public function sensors(): HasMany
    {
        return $this->hasMany(Sensor::class);
    }

    public function parkingSlots(): HasManyThrough
    {
        return $this->hasManyThrough(ParkingSlot::class, Sensor::class);
    }

    public function parkedCars()
    {
        return $this->hasMany(ParkedCar::class, 'parking_house_id');
    }
}

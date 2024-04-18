<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Sensor extends Model
{
    use HasFactory;

    public function parkingSlot() : BelongsTo
    {
        return $this->belongsTo(ParkingSlot::class);
    }

    public function parkingHouse() : HasOneThrough
    {
        return $this->hasOneThrough(ParkingHouse::class, ParkingSlot::class);
    }
}

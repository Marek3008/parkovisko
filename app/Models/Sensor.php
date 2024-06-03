<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Sensor extends Model
{
    use HasFactory;

    public function parkingSlot() : HasOne
    {
        return $this->hasOne(ParkingSlot::class);
    }

    public function parkingHouse() : BelongsTo
    {
        return $this->belongsTo(ParkingHouse::class);
    }

    public function device() : BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}

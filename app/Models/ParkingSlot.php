<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ParkingSlot extends Model
{
    use HasFactory;

    public function sensor() : HasOne
    {
        return $this->hasOne(Sensor::class);
    }
    
    public function parkingHouse() : BelongsTo
    {
        return $this->belongsTo(ParkingHouse::class);
    }
}

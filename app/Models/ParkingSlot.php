<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class ParkingSlot extends Model
{
    use HasFactory;

    public function sensor() : BelongsTo
    {
        return $this->belongsTo(Sensor::class);
    }
    
}

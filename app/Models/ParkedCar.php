<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkedCar extends Model
{
    use HasFactory;

    public function parkingHouse(){
        return $this->belongsTo(ParkingHouse::class, 'parking_house_id');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AllowedCars;
use App\Models\ParkedCar;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function getParkingSlots(){
        return ParkingSlot::with('sensor')->get();
    }

    public function getParkedCars(){
        return ParkedCar::all();
    }

    public function getAllowedCars(){
        return AllowedCars::all();
    }
}

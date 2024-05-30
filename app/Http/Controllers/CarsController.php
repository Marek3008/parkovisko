<?php

namespace App\Http\Controllers;

use App\Models\AllowedCars;
use App\Models\ParkedCar;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function getParkingSlots(){
        return ParkingSlot::with('sensor')->whereHas('sensor', function($query) { 
            $query->where('parking_house_id', session('parkingHouse')); 
        })->get();
    }

    public function getParkedCars(){
        return ParkedCar::where("parking_house_id", session("parkingHouse"))->get();
    }

    public function getAllowedCars(){
        return AllowedCars::where("parking_house_id", session("parkingHouse"))->get();
    }
}

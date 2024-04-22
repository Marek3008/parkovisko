<?php

use App\Models\AllowedCars;
use App\Models\ParkedCar;
use App\Models\ParkingHouse;
use App\Models\ParkingSlot;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', ["slots" => ParkingSlot::with('sensor')->get(), "parkingHouse" => ParkingHouse::where('id', 1)->first(), "parkedCars" => ParkedCar::all()]);
});

Route::get('/banasko', function(){
    return ParkingSlot::with('sensor')->get();
})->name('banasko');

Route::get('/allowed-cars', function(){
    $cars = AllowedCars::all();

    return view('allowed', ["cars" => $cars]);
})->name('allowedCars');

Route::delete('/allowed-cars/{id}', function($id){
    AllowedCars::where('id', $id)->delete();
    return;
});
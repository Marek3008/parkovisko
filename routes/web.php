<?php

use App\Models\AllowedCars;
use App\Models\ParkedCar;
use App\Models\ParkingHouse;
use App\Models\ParkingSlot;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', ["slots" => ParkingSlot::with('sensor')->get(), "parkingHouse" => ParkingHouse::where('id', 1)->first(), "parkedCars" => ParkedCar::all()]);
})->name('index');

Route::get('/request-parking-slots', function(){
    return ParkingSlot::with('sensor')->get();
})->name('requestParkingSlots');

Route::get('/request-parked-cars', function(){
    return ParkedCar::all();
})->name('requestParkedCars');

Route::get('/request-allowed-cars', function(){
    return AllowedCars::all();
})->name('requestAllowedCars');

Route::get('/allowed-cars', function(){
    return view('allowed', ["cars" => AllowedCars::orderBy('id', 'desc')->get()]);
})->name('allowedCars');

Route::get('/settings', function(){
    return view('settings', ['sensors' => Sensor::all(), 'parkingHouses' => ParkingHouse::all()]);
})->name('settings');

Route::post('/allowed-cars/{name}', function($name){
    AllowedCars::create(["spz" => $name]);
    return;
});

Route::delete('/allowed-cars/{id}', function($id){
    AllowedCars::where('id', $id)->delete();
    return;
});
<?php

use App\Models\ParkedCar;
use App\Models\ParkingSlot;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', ["slots" => ParkingSlot::with('sensor')->get()]);
});

Route::get('/banasko', function(){
    return ParkingSlot::with('sensor')->get();
})->name('banasko');
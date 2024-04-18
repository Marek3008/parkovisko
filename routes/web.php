<?php

use App\Models\ParkedCar;
use App\Models\ParkingSlot;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/banasko', function(){
    return ParkingSlot::all();
})->name('banasko');
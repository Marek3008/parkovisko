<?php

use App\Http\Controllers\AllowedCarsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsController;
use App\Models\AllowedCars;
use App\Models\ParkedCar;
use App\Models\ParkingHouse;
use App\Models\ParkingSlot;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::get('/', function () {

        if(session()->has('parkingHouse')){
            $parkingHouseId = session('parkingHouse');
        }
        else {
            $parkingHouseId = ParkingHouse::first()->id;
        }
        $parkingHouse = ParkingHouse::find($parkingHouseId);

        $slots = ParkingSlot::with('sensor')->whereHas('sensor', function($query) use($parkingHouseId) { 
            $query->where('parking_house_id', $parkingHouseId); 
        })->get();

        $parkedCars = ParkedCar::where('parking_house_id', $parkingHouseId);

        return view('index', [
            "slots" =>  $slots, 
            "parkingHouse" => $parkingHouse, 
            "parkedCars" => $parkedCars
        ]);
    })->name('index');


    Route::resource('allowed-cars', AllowedCarsController::class)->only(['index', 'store', 'destroy']);
   

    Route::get('/request-parking-slots', [CarsController::class, 'getParkingSlots'])->name('requestParkingSlots');
    Route::get('/request-parked-cars', [CarsController::class, 'getParkedCars'])->name('requestParkedCars');
    Route::get('/request-allowed-cars', [CarsController::class, 'getAllowedCars'])->name('requestAllowedCars');
    

    Route::get('/settings', function(){
        return view('settings', ['sensors' => Sensor::all(), 'parkingHouses' => ParkingHouse::all()]);
    })->name('settings');

    Route::post('/settings/change-house', function(Request $request){

        $parkingHouse = $request['parkingHouse'];

        session(["parkingHouse" => $parkingHouse]);

        return redirect()->route('index');
    })->name('change-parking-house');
    

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'index'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});



<?php

use App\Http\Controllers\AllowedCarsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\SettingsController;
use App\Models\ParkedCar;
use App\Models\ParkingHouse;
use App\Models\ParkingSlot;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {

        if (session()->has('parkingHouse')) {
            $parkingHouseId = session('parkingHouse');
        } else {
            session(['parkingHouse' => ParkingHouse::first()->id]);
            $parkingHouseId = session('parkingHouse');
        }
        $parkingHouse = ParkingHouse::find($parkingHouseId);

        $slots = ParkingSlot::with('sensor')->whereHas('sensor', function ($query) use ($parkingHouseId) {
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


    Route::prefix('settings')->group(function () {

        Route::get('', [SettingsController::class, 'index'])->name('settings');
        Route::post('/change-house', [SettingsController::class, 'changeHouse'])->name('change-parking-house');
        Route::post('/change-sensor/{id}', [SettingsController::class, 'changeSensor'])->name('change-sensor');
        Route::post('/change-mode/{mode}', [SettingsController::class, 'changeMode'])->name('change-mode');
    });




    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

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

        $parkedCars = ParkedCar::where('parking_house_id', $parkingHouseId)->get();

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
    Route::get('/request-parking-houses', [CarsController::class, 'getParkingHouses'])->name('requestParkingHouses');


    Route::prefix('settings')->group(function () {

        Route::get('', [SettingsController::class, 'index'])->name('settings');
        Route::post('/change-house', [SettingsController::class, 'changeHouse'])->name('change-parking-house');
        Route::post('/change-sensor/{id}', [SettingsController::class, 'changeSensor'])->name('change-sensor');
        Route::post('/change-mode/{mode}', [SettingsController::class, 'changeMode'])->name('change-mode');
    });


    Route::get('/parkingHouses', function(){
        $parkingHouses = ParkingHouse::all();

        return view('parkingHouses', [
            "houses" => $parkingHouses
        ]);
    })->name('parkingHouses');

    Route::post('/parkingHouses', function() {
        $name = trim(request()->header('Name'));
        $location = trim(request()->header('Location'));

        try{
            if(strlen($name) > 32 || strlen($location) > 100){
                throw new Exception("Limit of Name is 32 and of Location 100");
            }
            else if(strlen($name) == 0 || strlen($location) === 0){
                throw new Exception("Cannot add empty string");
            }
        }
        catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

        ParkingHouse::create([
            "name" => $name,
            "location" => $location
        ]);
        return;
    });

    Route::delete('/parkingHouses/{id}', function($id){
        ParkingHouse::where('id', $id)->delete();
        return; 
    });

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

<?php

use App\Models\ParkedCar;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/banasko', function(){
    return ParkedCar::all();
})->name('banasko');
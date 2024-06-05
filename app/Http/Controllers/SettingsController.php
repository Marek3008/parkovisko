<?php

namespace App\Http\Controllers;

use App\Models\ParkingHouse;
use App\Models\Sensor;
use Exception;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings', ['sensors' => Sensor::all(), 'parkingHouses' => ParkingHouse::all(), 'currentHouse' => ParkingHouse::find(session('parkingHouse'))]);
    }

    public function changeHouse(Request $request)
    {

        $parkingHouse = $request['parkingHouse'];

        session(["parkingHouse" => $parkingHouse]);

        return redirect()->route('index');
    }

    public function changeSensor(Request $request, $id)
    {
        $name = trim($request->header('Name'));

        try {
            if (strlen($name) > 32) {
                throw new Exception("Limit is 32 characters");
            } else if (strlen($name) == 0) {
                throw new Exception("Cannot add empty string");
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


        $sensor = Sensor::find($id);
        $sensor->name = $request->header('Name');
        $sensor->save();

        return;
    }

    public function changeMode($mode)
    {
        $parkingHouse = ParkingHouse::find(session('parkingHouse'));
        $parkingHouse->mode = $mode;
        $parkingHouse->save();
    }
}

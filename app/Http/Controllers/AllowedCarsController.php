<?php

namespace App\Http\Controllers;

use App\Models\AllowedCars;
use Exception;
use Illuminate\Http\Request;

class AllowedCarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('allowed', ["cars" => AllowedCars::where("parking_house_id", session("parkingHouse"))->orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $input = trim($request->header('Name'));

        try{
            if(strlen($input) > 10){
                throw new Exception("Limit is 10 characters");
            }
            else if(strlen($input) == 0){
                throw new Exception("Cannot add empty string");
            }
        }
        catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

        AllowedCars::create([
            "spz" => strtoupper($input),
            "parking_house_id" => session("parkingHouse")
        ]);
        return;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        AllowedCars::where('id', $id)->delete();
        return;
    }
}

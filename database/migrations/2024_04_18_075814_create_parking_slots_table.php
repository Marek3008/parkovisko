<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Sensor;
use App\Models\ParkingHouse;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parking_slots', function (Blueprint $table) {
            $table->id();
            $table->boolean("occupied")->default(false);
            $table->foreignIdFor(Sensor::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_slots');
    }
};

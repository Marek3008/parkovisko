<?php

use App\Models\ParkingHouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('allowed_cars', function(Blueprint $table){
            $table->foreignIdFor(ParkingHouse::class)->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('allowed_cars', function(Blueprint $table){
            $table->dropForeign('parking_house_id');
        });
    }
};

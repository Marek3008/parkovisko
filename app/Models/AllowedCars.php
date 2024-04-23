<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedCars extends Model
{
    use HasFactory;

    protected $fillable = [
        "spz"
    ];
}

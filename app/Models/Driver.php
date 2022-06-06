<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'drivers';
    protected $guarded = [];

    public function cars(){
        return $this->belongsToMany(Car::class, 'car_drivers', 'driver_id', 'car_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDriver extends Model
{
    use HasFactory;

    protected $table = 'car_drivers';
    protected $guarded = [];
    public $timestamps = false;
}

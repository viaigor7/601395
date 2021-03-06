<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    use Filterable;

    protected $table = 'cars';
    protected $guarded = false;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function drivers(){
        return $this->belongsToMany(Driver::class, 'car_drivers', 'car_id', 'driver_id');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use App\Models\Driver;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(Car $car){
        $categories = Category::all();
        $drivers = Driver::all();

        return view('car.edit', compact('car', 'drivers', 'categories'));
    }

    public function update(Car $car){
        $cars = request()->validate([
            'name' => 'string',
            'model' => 'string',
            'year' => 'integer',
            'category_id' => 'integer',
            'drivers' => 'array'
        ]);

        if(isset($cars['drivers'])){
            $drivers = $cars['drivers'];

            unset($cars['drivers']);
        }

        $car->update($cars);

        if(isset($drivers)){
            $car->drivers()->sync($drivers);
        }

        return redirect()->route('home');
    }

    public function destroy(Car $car){
        $car->delete();

        return redirect()->route('home');
    }

    public function categoryEdit(Category $category){
        return view('car.category.edit', compact('category'));
    }

    public function categoryUpdate(Category $category){
        $categorys = request()->validate([
            'name' => 'string',
        ]);

        $category->update($categorys);

        return redirect()->route('home');
    }

    public function categoryDestroy(Category $category){
        $category->delete();

        return redirect()->route('home');
    }

    public function driverEdit(Driver $driver){
        $cars = Car::all();

        return view('car.driver.edit', compact('driver', 'cars'));
    }

    public function driverUpdate(Driver $driver){
        $drivers = request()->validate([
            'name' => 'string',
            'cars' => 'array'
        ]);

        if($drivers['cars']){
            $cars = $drivers['cars'];

            unset($drivers['cars']);
        }

        $driver->update($drivers);

        if(isset($cars)){
            $driver->cars()->sync($cars);
        }

        return redirect()->route('home');
    }

    public function driverDestroy(Driver $driver){
        $driver->delete();

        return redirect()->route('home');
    }
}

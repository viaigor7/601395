<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\Car;
use App\Models\Category;
use App\Models\Driver;
use App\Models\CarDriver;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = $this->categories();
        $drivers = $this->drivers();
        $cars = $this->cars();
        $urls = $this->url();

        return view('home', ['cars' => $cars, 'urls' => $urls, 'categories' => $categories, 'drivers' => $drivers]);
    }

    public function create()
    {
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

        $car = Car::create($cars);

        if(isset($drivers)){
            $car->drivers()->attach($drivers);
        }

        return redirect()->route('home');
    }

    public function createCategiry()
    {
        $category = request()->validate([
            'name' => 'string',
        ]);

        Category::create($category);

        return redirect()->route('home');
    }

    public function createDriver()
    {
        $driver = request()->validate([
            'name' => 'string',
            'cars' => 'array'
        ]);

        if(isset($driver['cars'])){
            $cars = $driver['cars'];

            unset($driver['cars']);
        }

        $drivers = Driver::create($driver);

        if(isset($cars)){
            $drivers->cars()->attach($cars);
        }

        return redirect()->route('home');
    }

    private function cars(){
        if($this->cars_filter()){
            return $this->cars_filter();
        } else {
            return Car::withCount('drivers')->with('category')->get();;
        }
    }

    private function categories(){
        return Category::all();
    }

    private function drivers() {
        return Driver::all();
    }

    private function cars_filter(){
        $cars = [];

        if(isset($_GET['name'])){
            $cars = Car::withCount('drivers')->orderBy('name', $_GET['name'])->get();
        } else if (isset($_GET['model'])){
            $cars = Car::withCount('drivers')->orderBy('model', $_GET['model'])->get();
        } else if (isset($_GET['year'])){
            $cars = Car::withCount('drivers')->orderBy('year', $_GET['year'])->get();
        }

        return $cars;
    }

    private function url(){
        $urls = [
            'name' => route('home', ['name' => (isset($_GET['name'])) && $_GET['name'] == 'desc' ? 'asc' : 'desc']),
            'model' => route('home', ['model' => (isset($_GET['model'])) && $_GET['model'] == 'desc' ? 'asc' : 'desc']),
            'category' => route('home', ['category' => (isset($_GET['category'])) && $_GET['category'] == 'desc' ? 'asc' : 'desc']),
            'year' => route('home', ['year' => (isset($_GET['year'])) && $_GET['year'] == 'desc' ? 'asc' : 'desc'])
        ];
        
        return $urls;
    }
}

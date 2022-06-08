<?php

namespace App\Http\Controllers;

use App\Http\Filters\CarFilter;
use App\Http\Requests\FilterRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\Car;
use App\Models\Category;
use App\Models\Driver;
use App\Models\CarDriver;
use App\Http\Requests\CarRequest;

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
    public function index(FilterRequest $request)
    {
        $categories = $this->categories();
        $drivers = $this->drivers();
        $cars = $this->cars($request);
        $urls = $this->url();
        $dataGet = $request->validated();

        return view('home', ['cars' => $cars, 'urls' => $urls, 'categories' => $categories, 'drivers' => $drivers, 'dataGet' => $dataGet]);
    }

    public function create(CarRequest $request)
    {
        $cars = $request->validated();

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

    private function cars($request){
        if($this->cars_filter($request)){
            return $this->cars_filter($request);
        } else {
            return Car::withCount('drivers')->with('category')->paginate(10);
        }
    }

    private function cars_filter($request){
        $cars = [];

        $data = $request->validated();

        if(!empty($data) || isset($_GET['orderName']) || isset($_GET['orderModel']) || isset($_GET['orderYear'])) {
            $query = Car::query()->withCount('drivers');

            if(isset($data['name'])){
                $query->where('name', 'like','%'.$data['name'].'%');
            }
            if(isset($data['model'])){
                $query->where('model', 'like','%'.$data['model'].'%');
            }
            if(isset($data['year'])){
                $query->where('year', 'like','%'.$data['year'].'%');
            }
            $cars = $query->paginate(10);

            if (isset($_GET['orderName'])) {
                $cars = Car::withCount('drivers')->orderBy('name', $_GET['orderName'])->get();
            } else if (isset($_GET['orderModel'])) {
                $cars = Car::withCount('drivers')->orderBy('model', $_GET['orderModel'])->get();
            } else if (isset($_GET['orderYear'])) {
                $cars = Car::withCount('drivers')->orderBy('year', $_GET['orderYear'])->get();
            }
        }

        return $cars;
    }

    private function categories(){
        return Category::all();
    }

    private function drivers() {
        return Driver::all();
    }

    private function url(){
        $urls = [
            'orderName' => route('home', ['orderName' => (isset($_GET['orderName'])) && $_GET['orderName'] == 'desc' ? 'asc' : 'desc']),
            'orderModel' => route('home', ['orderModel' => (isset($_GET['orderModel'])) && $_GET['orderModel'] == 'desc' ? 'asc' : 'desc']),
            'category' => route('home', ['category' => (isset($_GET['category'])) && $_GET['category'] == 'desc' ? 'asc' : 'desc']),
            'orderYear' => route('home', ['orderYear' => (isset($_GET['orderYear'])) && $_GET['orderYear'] == 'desc' ? 'asc' : 'desc'])
        ];

        return $urls;
    }
}

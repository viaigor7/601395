<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

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
        $error = [
            'name' => '',
            'model' => '',
            'year' => ''
        ];

        // if($_GET()){
        //    $this->cars_filter();
        // }

        $cars = $this->cars();
        $urls = $this->url();
        $urls = $this->url();

        return view('home', ['cars' => $cars, 'error' => $error, 'urls' => $urls]);
    }

    public function create()
    {
        $error = [
            'name' => '',
            'model' => '',
            'year' => ''
        ];

        if(isset($_POST['name']) && isset($_POST['model']) && isset($_POST['year'])){
            if($_POST['name'] != '' && $_POST['model'] != '' && $_POST['year'] != ''){
                Car::create([
                    'name' => $_POST['name'],
                    'model' => $_POST['model'],
                    'year' => $_POST['year']
                ]);
            } else {
                $error = [
                    'name' => $_POST['name'],
                    'model' => $_POST['model'],
                    'year' => $_POST['year']
                ];
            }
        }

        $cars = $this->cars();

        return view('home', ['cars' => $cars, 'error' => $error]);
    }

    private function cars(){
        if($this->cars_filter()){
            return $this->cars_filter();
        } else {
            return Car::all();
        }
    }

    private function cars_filter(){
        $cars = [];

        if(isset($_GET['name'])){
            $cars = Car::orderBy('name', $_GET['name'])->get();
        } else if (isset($_GET['model'])){
            $cars = Car::orderBy('model', $_GET['model'])->get();
        } else if (isset($_GET['year'])){
            $cars = Car::orderBy('year', $_GET['year'])->get();
        }

        return $cars;
    }

    private function url(){
        $urls = [
            'name' => route('home', ['name' => (isset($_GET['name'])) && $_GET['name'] == 'desc' ? 'asc' : 'desc']),
            'model' => route('home', ['model' => (isset($_GET['model'])) && $_GET['model'] == 'desc' ? 'asc' : 'desc']),
            'year' => route('home', ['year' => (isset($_GET['year'])) && $_GET['year'] == 'desc' ? 'asc' : 'desc'])
        ];
        
        return $urls;
    }
}

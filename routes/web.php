<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

if(isset($_POST['name']) && isset($_POST['model']) && isset($_POST['year'])){
    Route::post('/home', [App\Http\Controllers\HomeController::class, 'create'])->name('home');
} else {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
}
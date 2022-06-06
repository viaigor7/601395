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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
Route::post('/home/categiry', [App\Http\Controllers\HomeController::class, 'createCategiry'])->name('categiry');
Route::post('/home/driver', [App\Http\Controllers\HomeController::class, 'createDriver'])->name('driver');
Route::get('/home/{car}/edit', 'CarController@edit')->name('car.edit');
Route::patch('/home/{car}', 'CarController@update')->name('car.update');
Route::delete('/home/{car}', 'CarController@destroy')->name('car.delete');
Route::get('/home/category/{category}/edit', 'CarController@categoryEdit')->name('category.edit');
Route::patch('/home/category/{category}', 'CarController@categoryUpdate')->name('category.update');
Route::delete('/home/category/{category}', 'CarController@categoryDestroy')->name('category.delete');
Route::get('/home/driver/{driver}/edit', 'CarController@driverEdit')->name('driver.edit');
Route::patch('/home/driver/{driver}', 'CarController@driverUpdate')->name('driver.update');
Route::delete('/home/driver/{driver}', 'CarController@driverDestroy')->name('driver.delete');
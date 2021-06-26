<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;

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
    return view('auth.login');
});

//Auth::routes();

Auth::routes([
    'register' => false,
    'verify' => true,
    'reset' => false
  ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/changePassword','HomeController@ChangePasswordview');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
Route::get('/upload', 'HomeController@addcsv');
Route::post('/upload', 'HomeController@upload');
Route::get('/edit', 'HomeController@editprofile');
Route::post('/save', 'HomeController@update');
Route::get('/download', 'HomeController@export');
Route::get('/delete', 'HomeController@table');
Route::delete('delete/{id}', 'HomeController@destroy');
Route::delete('userDeleteAll', 'HomeController@deleteAll');


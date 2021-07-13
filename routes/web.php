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
    'reset' => true
  ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/changePassword','HomeController@ChangePasswordview');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
Route::get('/upload', 'HomeController@addcsv');
Route::post('/upload', 'HomeController@upload');
Route::get('/edit', 'HomeController@editprofile');
Route::post('/save', 'HomeController@update');
Route::get('/download', 'HomeController@export');
Route::get('/template', 'HomeController@template');
//Route::get('/delete', 'HomeController@table');
Route::get('users/{id}', 'HomeController@destroy');
//Route::delete('userDeleteAll', 'HomeController@deleteAll');
//Route::get('/records/srech', 'HomeController@search')->name('search');

Route::get('users', ['uses'=>'HomeController@usertable', 'as'=>'users.usertable']);
Route::get('/email', 'HomeController@email');
Route::post('/all', 'HomeController@all');
Route::post('/university', 'HomeController@university');
Route::post('/group', 'HomeController@group');
Route::post('/section', 'HomeController@section');
Route::post('/marks', 'HomeController@marks');

Route::post('user/update', 'HomeController@aupdate')->name('user.update');
Route::get('users/edit/{id}', 'HomeController@edit');
Route::get('/addmarks', 'HomeController@addmarks');
Route::post('/postmarks', 'HomeController@tmarks');
Route::get('/performance', 'HomeController@performance');
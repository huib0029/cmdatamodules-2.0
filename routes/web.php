<?php

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
Route::get('api', function () {
    return view('api');
});
Route::get('angular', function () {
    return view('angular');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Alles van de task pagina wordt geladen naar de taskcontroller
Route::resource('/task', 'TaskController');

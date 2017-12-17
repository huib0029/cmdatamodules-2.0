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

// API maakt gebruik van een Angular controller en services (zie resources/assets/js/app.js)
Route::get('api', function () {
    return view('api');
});
// De Tasks pagina maakt gebruik van een combinatie van Angular en Laravel
Route::get('tasks', function () {
    return view('tasks');
});

Route::get('search', function () {
    return view('search');
});

Auth::routes();

// name -> route naar index
Route::get('home', 'HomeController@index')->name('index');

// Alles methoden van de task pagina wordt geladen naar de taskcontroller
Route::resource('task', 'TaskController');

// Redirecten naar login pagina van OpenIDConnect
Route::get('openidconnect', 'Controller@openlogin');

// callback pagina aangemaakt in web URL voor OpenIDConnect
Route::get('callback', 'Controller@callback')->name('callback');

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
Route::get('tasks', function () {
    return view('tasks');
});

Auth::routes();

// name -> route naar index
Route::get('/home', 'HomeController@index')->name('index');
// callback pagina aangemaakt in web URL
Route::get('/callback', 'Controller@callback')->name('callback');

// Alles van de task pagina wordt geladen naar de taskcontroller
Route::resource('/task', 'TaskController');

// Redirecten naar login pagina van OpenIDConnect
Route::get('openidconnect', 'Controller@openlogin');

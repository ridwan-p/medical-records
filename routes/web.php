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

Auth::routes([
    'register' => false,
    'reset' => false,
]);

// Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('dashboard')
->namespace('Dashboard')
->name('dashboard.')
->middleware('auth')
->group(function() {
	Route::get('/', "DashboardController@index")->name('index');
	Route::resource('patients', "PatientController");
	// Route::get('/home', 'HomeController@index')->name('home');
});

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
    return redirect()->route('login');
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

	Route::get('profile', "ProfileController@index")->name('profile.index');
	Route::put('profile', "ProfileController@update")->name('profile.update');
	Route::patch('profile', "ProfileController@update")->name('profile.update');

	Route::resource('patients', "PatientController");
	Route::get('patients/{patient}/journals/add', "PatientController@createJournal")->name('patients.journals.add');
	Route::post('patients/{patient}/journals/add', "PatientController@storeJournal")->name('patients.journals.store');

	// Journal in patient
	Route::get('patients/{journal}/journals/edit', "PatientController@editJournal")->name('patients.journals.edit');
	Route::put('patients/{journal}/journals/add', "PatientController@updateJournal")->name('patients.journals.update');
	Route::patch('patients/{journal}/journals/add', "PatientController@updateJournal")->name('patients.journals.update');

	// export patient
	Route::post('patients/export/list', "PatientController@exportList")->name('patients.export.list');
	Route::post('patients/export/stroe', "PatientController@exportStore")->name('patients.export.store');

	// Journal
	Route::resource('journals', "JournalController");
	Route::get('history', "HistoryController@index")->name('history.index');
	// Route::get('/home', 'HomeController@index')->name('home');
});

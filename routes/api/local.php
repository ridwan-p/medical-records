<?php

Route::middleware('auth')
	->group(function() {
		Route::get('medications', "MedicationController@index")->name('medications');
		Route::get('diagnosis', "DiagnoseController@index")->name('diagnosis');
	});
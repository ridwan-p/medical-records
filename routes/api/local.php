<?php

Route::middleware('auth')
	->group(function() {
		// Patient
		Route::get('patients', "PatientController@index")->name('patients.index');
		// journal 
		Route::get('journals', 'JournalController@index')->name('journals.index');

		Route::get('medications', "MedicationController@index")->name('medications.index');
		Route::get('diagnosis', "DiagnoseController@index")->name('diagnosis.index');
	});
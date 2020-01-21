<?php

Route::middleware('auth')
	->group(function() {
		// Patient
		Route::get('patients', "PatientController@index")->name('patients.index');
		// journal
		Route::get('journals', 'JournalController@index')->name('journals.index');
		// history
		Route::get('history', 'HistoryController@index')->name('history.index');
		Route::get('history-show-all', 'HistoryController@showAll')->name('history.showAll');


		Route::get('medications', "MedicationController@index")->name('medications.index');
		Route::get('medications-show-all', 'MedicationController@showAll')->name('medications.showAll');
		Route::get('medications-count', 'MedicationController@count')->name('medications.count');
		Route::get('diagnosis', "DiagnoseController@index")->name('diagnosis.index');
		Route::get('diagnosis-show-all', 'DiagnoseController@showAll')->name('diagnosis.showAll');
		Route::get('diagnosis-count', 'DiagnoseController@count')->name('diagnosis.count');
	});
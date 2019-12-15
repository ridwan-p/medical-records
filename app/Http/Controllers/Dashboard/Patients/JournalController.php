<?php

namespace App\Http\Controllers\Dashboard\Patients;

use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index(Request $request , Patient $patient)
    {
    	return view('dashbaord.patients.journal.index', compact('patient'));
    }

    public function create(Patient $patient)
    {
    	return view('dashbaord.patients.journals.create', compact('patient'));
    }

    public function store(Request $request, Patient $patient)
    {
    	$request->validate([
	    	'action' => 'required',
	    	'note' => 'nullable',
	    	'anamnese' => 'required|array',
	    	'diagnosis' => 'required|array',
	    	'medications' => 'required|array'
    	]);

    	$journal = DB::transaction(function() use ($request) {
    		$journal = new Journal($request->except('medications'));
    		$journal->save();
    		$journal->storeMany($request->only('medications'));
    		return $journal;
    	});

        session()->flash('success', 'Data has been created');

    	return redirect()->route('dashbaord.patients.journals.index', ['patient' => $patient]);
    }

    public function edit(Patient $patient, Journal $journal)
    {
    	return view('dashbaord.patients.journals.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient, Journal $journal)
    {
    	$request->validate([
	    	'action' => 'required',
	    	'note' => 'nullable',
	    	'anamnese' => 'required|array',
	    	'diagnosis' => 'required|array',
	    	'medications' => 'required|array'
    	]);

    	$journal = DB::transaction(function() use ($request, $journal) {
    		$journal->fill($request->except('medications'));
    		$journal->save();
    		$journal->updateMany($request->only('medications'));
    		return $journal;
    	});


        session()->flash('success', 'Data has been updated');
    	return redirect()->back(); 
    }

    public function destroy(Patient $patient, Journal $journal)
    {
    	$journal->medications()->detach();
    	$journal->delete();

        session()->flash('success', 'Data has been deleted');
    	return redirect()->back();
    }
}

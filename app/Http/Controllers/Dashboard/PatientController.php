<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;
use DB;

class PatientController extends Controller
{
    public function index(Request $request)
    {
    	$patients = Patient::paginate();
    	return view('dashboard.patients.index', compact('patients'));
    }

    public function create()
    {
    	return view('dashboard.patients.create');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'name' => 'required',
	    	'address' => 'required',
	    	'date_of_birth' => 'nullable|date',
	    	'place_of_birth' => 'nullable',
	    	'gender' => 'required|in:m,f',
	    	'blood' => 'nullable|in:a,b,ab,o',
	    	'phone' => 'nullable|max:25',
	    	'parent' => 'required|max:50',
	    	'allergies' => 'nullable|array'
    	]);

    	$patient = DB::transaction(function() use ($request) {
	    	$patient = new Patient();
	    	$patient->fill($request->all());
	    	$patient->save();
	    	$patient->storeMeta($request->only('allergies'));
	    	return $patient;
    	});

    	session()->flash('success', 'Add');
    	return redirect()->route('dashboard.patients.index');
    }

    public function show(Patient $patient)
    {
    	return view('dashboard.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
    	return view('dashboard.patients.edit', compact('patient'));
    }

    public function update(Patient $patient, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'date_of_birth' => 'nullable|date',
            'place_of_birth' => 'nullable',
            'gender' => 'required|in:m,f',
            'blood' => 'nullable|in:a,b,ab,o',
            'phone' => 'nullable|max:25',
            'parent' => 'required|max:50',
            'allergies' => 'nullable|array'
        ]);

        $patient = DB::transaction(function() use ($request, $patient) {
            $patient->fill($request->all());
            $patient->save();
            $patient->storeMeta($request->only('allergies'));
            return $patient;
        });

        session()->flash('success', 'Update');

    	return redirect()->back();;
    }

    public function delete(Patient $patient)
    {
    	$patient->delete();
    	return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Journal;
use App\Patient;
use DB;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
    	$patients = Patient::where(function($query) use ($request) {
            if($request->has('search')) {
                $query->where('name', 'like', "%{$request->search}%")
                    ->orWhere('parent', 'like', "%{$request->search}%");
            }
        })
        ->orderBy($request->column ?? 'created_at', $request->direction ?? 'desc')
        ->paginate(8);

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
	    	'allergies' => 'nullable|array',
            'photo' => 'nullable|image'
    	]);
    	$patient = DB::transaction(function() use ($request) {
	    	$patient = new Patient();
	    	$patient->fill($request->all());
	    	$patient->save();
	    	return $patient;
    	});

    	session()->flash('success', 'Add');
    	return redirect()->route('dashboard.patients.index');
    }

    public function show(Patient $patient)
    {
        $journals = $patient->journals()
            ->orderBy('created_at', 'desc')
            ->paginate();

        $patient->setRelation('journals', $journals);

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
            'allergies' => 'nullable|array',
            'photo' => 'nullable|image'
        ]);

        $patient = DB::transaction(function() use ($request, $patient) {
            $patient->fill($request->all());
            $patient->save();
            return $patient;
        });

        session()->flash('success', 'Update');

    	return redirect()->back();;
    }

    public function destroy(Patient $patient)
    {
        $patient->journals()->delete();
    	$patient->delete();
        session()->flash('success', 'Delete');
    	return redirect()->route('dashboard.patients.index');
    }

    public function createJournal(Patient $patient)
    {
        return view('dashboard.patients.create_journal', compact('patient'));
    }


    public function storeJournal(Request $request, Patient $patient)
    {
        $request->validate([
            'therapy' => 'required|array',
            'anamnese' => 'required|array',
            'diagnosis' => 'required|array',
            'medications' => 'required|array',
            'note' => 'nullable',
        ]);

        $journal = DB::transaction(function () use ($request, $patient) {
            $journal = new Journal($request->except('medications'));
            $patient->journals()->save($journal);
            $journal->storeToMany($request->only('medications'));

            return $journal;
        });

        session()->flash('success', 'Add');
        return redirect()->route('dashboard.patients.show', ['patient' => $patient]); 
    }

    public function editJournal(Journal $journal)
    {
        $patient = $journal->patient;

        return view('dashboard.patients.edit_journal', compact('journal', 'patient'));
    }


    public function updateJournal(Request $request, Journal $journal)
    {
        $request->validate([
            'therapy' => 'required|array',
            'anamnese' => 'required|array',
            'diagnosis' => 'required|array',
            'medications' => 'required|array',
            'note' => 'nullable',
        ]);

        $journal = DB::transaction(function () use ($request, $journal) {
            $journal->fill($request->except('medications'));
            $journal->storeToMany($request->only('medications'));

            return $journal;
        });

        session()->flash('success', 'update');
        return back();
    }
}

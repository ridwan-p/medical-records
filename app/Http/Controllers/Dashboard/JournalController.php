<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Journal;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    public function index(Request $request)
    {
    	$journals = Journal::whereHas('patient', function ($query) use ( $request ) {
    		if($request->has('search')) {
	    		$query->where('name', 'like', "%{$request->search}%")
	    			->orWhere('parent','like', "%{$request->search}%");
    		}
    	})
        ->orderBy($request->column ?? 'created_at', $request->direction ?? 'desc')
        ->paginate();

    	return view('dashboard.journals.index', compact('journals'));
    }

    public function create()
    {
    	$patients = Patient::all();

    	return view('dashboard.journals.create', compact('patients'));
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'patient_id' => 'required|exists:patients,id',
    		'action' => 'nullable|array',
            'anamnese' => 'required|array|min:1',
            'diagnosis' => 'required|array|min:1',
            'medications' => 'required|array|min:1',
            // 'action.*' => 'string',
            'anamnese.*' => 'required|max:255',
            'diagnosis.*.name' => 'required|max:255',
            'medications.*.name' => 'required|max:255',
            'note' => 'nullable',
    	]);

    	$journal = DB::transaction(function () use ($request) {
    		$journal = new Journal($request->except('medications', 'diagnosis'));
    		$journal->save();
    		$journal->storeToMany($request->only('medications', 'diagnosis'));

    		return $journal;
    	});

    	session()->flash('success', 'Data has been craeted');
    	return redirect()->route('dashboard.journals.index');
    }

    public function edit(Journal $journal)
    {
        $patients = Patient::all();
    	return view('dashboard.journals.edit', compact('journal', 'patients'));
    }

    public function update(Request $request, Journal $journal)
    {
    	$request->validate([
    		'patient_id' => 'required|exists:patients,id',
    		'action' => 'nullable|array',
            'anamnese' => 'required|array|min:1',
            'diagnosis' => 'required|array|min:1',
            'medications' => 'required|array|min:1',
            // 'action.*' => 'string',
            'anamnese.*' => 'required|max:255',
            'diagnosis.*.name' => 'required|max:255',
            'medications.*.name' => 'required|max:255',
            'note' => 'nullable',
    	]);

    	$journal = DB::transaction(function () use ($request, $journal) {
    		$journal->fill($request->except('diagnosis', 'medications'));
    		$journal->save();
            $journal->storeToMany($request->only('medications', 'diagnosis'));

    		return $journal;
    	});

    	session()->flash('success', 'Data has been updated');
    	return back();
    }

    public function destroy(Journal $journal)
    {
    	$journal->medications()->detach();
    	$journal->delete();

    	session()->flash('success', 'Data has been deleted');
    	return back();
    }
}

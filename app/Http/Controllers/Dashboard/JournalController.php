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
    	return view('dashboard.journals.index');
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
    		'therapy' => 'required',
			'note' => 'nullable',
			'anamnese' => 'required',
			'diagnosis' => 'required',
    	]);

    	$journal = DB::transaction(function () use ($request) {
    		$journal = new Journal($request->all());
    		$journal->save();

    		return $journal;
    	});
    }
}

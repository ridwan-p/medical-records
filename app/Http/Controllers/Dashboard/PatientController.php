<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\CSVConverter;
use App\Http\Controllers\Controller;
use App\Journal;
use App\Patient;
use App\Repositories\Code;
use DB;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
    	return view('dashboard.patients.index');
    }

    public function create()
    {
    	return view('dashboard.patients.create');
    }

    public function store(Request $request)
    {
    	$request->validate([
            // 'code' => 'required|unique:patients,code',
    		'name' => 'required',
	    	'address' => 'required',
	    	'date_of_birth' => 'nullable|date',
            'place_of_birth' => 'nullable',
	    	'age_of_birth' => 'nullable',
	    	'gender' => 'required|in:m,f',
	    	'blood' => 'nullable|in:a,b,ab,o',
	    	'phone' => 'nullable|max:25',
	    	'parent' => 'nullable|max:50', // temporarily
	    	'allergies' => 'nullable|array',
            'photo' => 'nullable|image',
            'age' => 'nullable|numeric'
    	]);

    	$patient = DB::transaction(function() use ($request) {
	    	$patient = new Patient();
	    	$patient->fill($request->all());
            $patient->generateCode();
	    	$patient->save();
	    	return $patient;
    	});

    	session()->flash('success', 'Data has been created');
    	return redirect()->route('dashboard.patients.show', ['patient' => $patient]);
    }

    public function show(Patient $patient)
    {
        $journals = $patient->journals()
            ->orderBy('created_at', 'desc')
            ->paginate();

        $patient->setRelation('journals', $journals);

    	return view('dashboard.patients.show', compact('patient', 'journals'));
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
            'age_of_birth' => 'nullable',
            'gender' => 'required|in:m,f',
            'blood' => 'nullable|in:a,b,ab,o',
            'phone' => 'nullable|max:25',
            'parent' => 'nullable|max:50',
            'allergies' => 'nullable|array',
            'photo' => 'nullable|image',
            'age' => 'nullable|numeric'
        ]);

        $patient = DB::transaction(function() use ($request, $patient) {
            $patient->fill($request->all());
            $patient->save();
            return $patient;
        });

        session()->flash('success', 'Data has been updated');

    	return redirect()->back();;
    }

    public function destroy(Patient $patient)
    {
        $patient = DB::transaction(function () use ($patient) {
            $patient->journals()->delete();
            $patient->delete();

            return $patient;
        });
        session()->flash('success', 'Data has been deleted');
    	return redirect()->route('dashboard.patients.index');
    }

    public function createJournal(Patient $patient)
    {
        $journals = $patient->journals()
            ->orderBy('created_at', 'desc')
            ->paginate();

        $patient->setRelation('journals', $journals);

        return view('dashboard.patients.create_journal', compact('patient'));
    }


    public function storeJournal(Request $request, Patient $patient)
    {
        $request->validate([
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

        $journal = DB::transaction(function () use ($request, $patient) {
            $journal = new Journal($request->except('medications', 'diagnosis'));
            $patient->journals()->save($journal);
            $journal->storeToMany($request->only('medications', 'diagnosis'));

            return $journal;
        });

        session()->flash('success', 'Data has been created');
        return redirect()->route('dashboard.patients.show', ['patient' => $patient]);
    }

    public function editJournal(Journal $journal)
    {
        $patient = $journal->patient;
        $journals = $patient->journals()
            ->orderBy('created_at', 'desc')
            ->paginate();

        $patient->setRelation('journals', $journals);

        return view('dashboard.patients.edit_journal', compact('journal', 'patient'));
    }


    public function updateJournal(Request $request, Journal $journal)
    {
        $request->validate([
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
            $journal->fill($request->except('medications', 'diagnosis'));
            $journal->save();
            $journal->storeToMany($request->only('medications', 'diagnosis'));

            return $journal;
        });

        session()->flash('success', 'Data has been updated');
        return back();
    }

    public function importList(Request $request)
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        $csv = (new CSVConverter($request->file->path()))->execute();
        $headers = $csv->getHeader();
        $patients = $csv->getData();
        session(['upload_csv' => serialize($csv)]);
        return view('dashboard.patients.import', compact('patients', 'headers'));
    }

    public function importStore()
    {
        $csv = session('upload_csv');

        if(isset($csv)) {
            $csv = unserialize($csv);
            $codes = $templates = [];
            $data = array_map(function($item) use (&$codes, &$templates) {
                $key = ucfirst(substr($item['name'], 0, 1));
                $codes[$key] = isset($codes[$key]) ? ++$codes[$key] : 0;
                $templates[$key] = $templates[$key] ?? Code::create($key);
                $templates[$key]->code_value = $codes[$key];

                $item['code'] = $templates[$key]->template();
                $item['date_of_birth'] = !empty($item['date_of_birth']) ? $item['date_of_birth'] : null;
                $item['created_at'] = now();
                $item['updated_at'] = now();

                return $item;
            }, $csv->getData());

            $isInsert = DB::transaction(function() use ($data, $templates) {
                foreach ($templates as $template) {
                    $template->save();
                }
                return Patient::insert($data);
            });
        }

        session()->flash('success', 'Data has been created');
        return redirect()->route('dashboard.patients.index');
    }
}

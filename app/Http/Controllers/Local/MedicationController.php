<?php

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use App\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicationController extends Controller
{
    public function index(Request $request)
    {
    	$medications = $this->getMedication($request)
    		->orderBy($request->column ?? "created_at", $request->direction ?? 'asc')
	    	->paginate($request->per_page);

    	return response()->json($medications);
    }

    public function showAll(Request $request)
    {
    	$medications = $this->getMedication($request)
    		->orderBy($request->column ?? "created_at", $request->direction ?? 'asc')
	    	->get();

    	return response()->json($medications);
    }


    public function count(Request $request)
    {
    	$medications = $this->getMedication($request)
	    	->select(DB::raw('count(*) as count, name'))
	    	->groupBy('name')
	    	->get();

    	return response()->json($medications);
    }

    private function getMedication(Request $request)
    {
    	return Medication::when(@$request->q, function($query, $keyword) {
	    		$query->where('name', 'like', "%{$keyword}%");
	    	});
    }
}

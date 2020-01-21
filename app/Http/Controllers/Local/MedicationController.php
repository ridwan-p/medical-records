<?php

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use App\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function index(Request $request)
    {
    	$medications = $this->getMedication($request)
	    	->paginate($request->per_page);

    	return response()->json($medications);
    }

    public function showAll(Request $request)
    {
    	$medications = $this->getMedication($request)
	    	->get();

    	return response()->json($medications);
    }

    private function getMedication(Request $request)
    {
    	return Medication::when(@$request->q, function($query, $keyword) {
	    		$query->where('name', 'like', "%{$keyword}%");
	    	})
	    	->orderBy($request->column ?? "created_at", $request->direction ?? 'asc');
    }
}

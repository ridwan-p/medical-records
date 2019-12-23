<?php

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use App\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function index(Request $request)
    {
    	$medications = Medication::when(@$request->q, function($query, $keyword) {
	    		$query->where('name', 'like', "%{$keyword}%");
	    	})
	    	->orderBy($request->column ?? "created_at", $request->direction ?? 'asc')
	    	->paginate($request->per_page);

    	return response()->json($medications);
    }
}

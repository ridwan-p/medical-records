<?php

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
    	$patients = Patient::when(@$request->q, function($query, $keyword) {
    		$query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('address', 'like', "%{$keyword}%")
                    ->orWhere('code', 'like', "%{$keyword}%");
    	})
    	->when(@$request->gender, function($query, $gender) {
    		$query->where('gender', $gender);
    	})
		->orderBy($request->sort_by ?? 'name', $request->direction ?? 'asc')
		->paginate($request->per_page);

    	return response()->json($patients);
    }
}

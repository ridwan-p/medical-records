<?php

namespace App\Http\Controllers\Local;

use App\Diagnose;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiagnoseController extends Controller
{
    public function index(Request $request)
    {
    	$diagnosis = $this->getDiagnose($request)
	    	->paginate($request->per_page);

    	return response()->json($diagnosis);
    }

    public function showAll(Request $request)
    {
    	$diagnosis = $this->getDiagnose($request)
	    	->get();

    	return response()->json($diagnosis);
    }

    private function getDiagnose(Request $request)
    {
    	return Diagnose::when(@$request->q, function($query, $keyword) {
	    		$query->where('name', 'like', "%{$keyword}%");
	    	})
	    	->orderBy($request->column ?? "created_at", $request->direction ?? 'asc');
    }
}

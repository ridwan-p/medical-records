<?php

namespace App\Http\Controllers\Local;

use App\Diagnose;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnoseController extends Controller
{
    public function index(Request $request)
    {
    	$diagnosis = $this->getDiagnose($request)
	    	->orderBy($request->column ?? "created_at", $request->direction ?? 'asc')
	    	->paginate($request->per_page);

    	return response()->json($diagnosis);
    }

    public function showAll(Request $request)
    {
    	$diagnosis = $this->getDiagnose($request)
	    	->orderBy($request->column ?? "created_at", $request->direction ?? 'asc')
	    	->get();

    	return response()->json($diagnosis);
    }

    public function count(Request $request)
    {
    	$medications = $this->getDiagnose($request)
	    	->select(DB::raw('count(*) as count, name'))
	    	->groupBy('name')
	    	->get();

    	return response()->json($medications);
    }

    private function getDiagnose(Request $request)
    {
    	return Diagnose::when(@$request->q, function($query, $keyword) {
	    		$query->where('name', 'like', "%{$keyword}%");
	    	});
    }
}

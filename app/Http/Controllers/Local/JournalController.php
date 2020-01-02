<?php

namespace App\Http\Controllers\Local;

use App\Journal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $journals = Journal::whereHas('patient', function ($query) use ( $request ) {
    		if($request->has('search')) {
	    		$query->where('name', 'like', "%{$request->se´arch}%");
    		}
    	})
        ->orderBy($request->column ?? 'created_at', $request->direction ?? 'desc')
        ->paginate();

        return response()->json(compact('journals'));
    }
}

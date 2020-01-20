<?php

namespace App\Http\Controllers\Local;

use App\Journal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $journals = Journal::with('patient', 'diagnosis')
            ->whereHas('patient', function ($query) use ( $request ) {
        		if($request->has('q')) {
    	    		$query->where('name', 'like', "%{$request->q}%");
        		}
        	})
            ->orderBy($request->column ?? 'created_at', $request->direction ?? 'desc')
            ->paginate($request->per_page);

        return response()->json($journals);
    }
}

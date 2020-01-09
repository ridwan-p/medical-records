<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Journal;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
    	$journals = Journal::whereHas('patient', function ($query) use ( $request ) {
        		if($request->has('search')) {
    	    		$query->where('name', 'like', "%{$request->search}%")
    	    			->orWhere('parent','like', "%{$request->search}%");
        		}
        	})
        	->when($request->date_start, function($query, $date_start) {
        		$query->whereDate('created_at', ">=", $date_start);
        	})
        	->when($request->date_end, function($query, $date_end) {
        		$query->whereDate('created_at', "<=", $date_end);
        	})
            ->orderBy($request->column ?? 'created_at', $request->direction ?? 'desc')
            ->paginate($request->per_page);

    	return view('dashboard.history.index', compact('journals'));
    }
}

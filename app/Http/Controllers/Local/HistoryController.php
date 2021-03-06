<?php

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use App\Journal;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
    	$journals = $this->getJournals($request)
            ->paginate($request->per_page);

        return response()->json($journals);
    }

    public function showAll(Request $request)
    {
        $journals = $this->getJournals($request)
            ->get();

        return response()->json($journals);
    }

    private function getJournals(Request $request)
    {
        return Journal::with('patient', 'diagnosis', 'medications')
            ->whereHas('patient', function ($query) use ( $request ) {
                if($request->has('q')) {
                    $query->where('name', 'like', "%{$request->q}%")
                        ->orWhere('code','like', "%{$request->q}%");
                }
            })
            ->when($request->date_start, function($query, $date_start) {
                $query->whereDate('created_at', ">=", $date_start);
            })
            ->when($request->date_end, function($query, $date_end) {
                $query->whereDate('created_at', "<=", $date_end);
            })
            ->orderBy($request->column ?? 'created_at', $request->direction ?? 'desc');
    }
}

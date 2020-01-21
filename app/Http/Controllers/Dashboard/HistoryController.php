<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Journal;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
    	return view('dashboard.history.index');
    }
}

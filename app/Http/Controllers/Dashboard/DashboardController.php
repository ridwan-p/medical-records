<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
    	return redirect()->route('dashboard.patients.index');
    	// return view('dashboard.index');
    }
}

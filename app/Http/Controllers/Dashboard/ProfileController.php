<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
    	$user = auth()->user();
    	return view('dashboard.profile', compact('user'));
    }

    public function update(Request $request)
    {
    	$request->validate([
    		'email' => 'required|email',
    		'name' => 'required|max:255',
    		'password' => 'nullable|confirmed'
    	]);	

    	$user = auth()->user();
    	$user->fill($request->except('password'));
    	
    	if(!empty($request->password)) {
    		$user->password = bcrypt($request->password);
    	}

    	$user->save();

    	session()->flash('success', 'Profile has been updated');
    	return back();
    }
}

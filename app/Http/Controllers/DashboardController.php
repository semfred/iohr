<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
    	return view('app.dashboard', [
    		'auth_user'	=>	Auth::user()
    	]);
    }
}

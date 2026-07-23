<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;

class HomeController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
        // Apply middleware to specific methods
        $this->middleware('auth')->except('index');
    }
    */
    

    public function index()
    {
        //$user = Auth::user();

        return view('dashboard');
    }

}

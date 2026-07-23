<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function courses()
    {
        return view('pages.courses');
    }

    public function opportunities()
    {
        return view('pages.opportunities');
    }

    public function about()
    {
        return view('pages.about');
    }
}
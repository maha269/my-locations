<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userLocations = auth()->user()->locations;
        return view('home', compact('userLocations'));
    }
}

<?php

namespace App\Http\Controllers;

class HomeController extends Controller {
    public function __construct() {
        $this->middleware('auth', ['except' => 'logout']);
    }
    
    public function index()
    {
        return view('home/index');
    }

    public function minor()
    {
        return view('home/minor');
    }
}

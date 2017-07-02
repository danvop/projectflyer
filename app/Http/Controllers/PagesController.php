<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{   
    public function __construct()
    {

        $this->middleware('auth');
        // parent::__construct();

    }
    public function home()
    {
        
        return view('pages.home');
    }
}

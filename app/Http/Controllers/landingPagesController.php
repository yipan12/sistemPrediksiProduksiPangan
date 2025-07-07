<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class landingPagesController extends Controller
{
    public function index(){
        return view('LandingPages');
    }
}

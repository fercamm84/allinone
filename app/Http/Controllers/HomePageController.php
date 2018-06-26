<?php

namespace App\Http\Controllers;

use App\Models\Section;

class HomePageController extends Controller
{

    public function __construct(){
    }

    public function index(){
        return view('home.home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Section;

class HomePageController extends Controller
{

    public function __construct(){
    }

    public function index(){
        print_r('prueba en home');
        return view('home.home');
    }
}

<?php

namespace App\Http\Controllers;

class HomePageController extends Controller
{

    public function __construct(){
    }

    public function index(){


        return view('home.home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Section;

class HomePageController extends Controller
{

    public function __construct(){
    }

    public function index(){
        phpinfo();die;
        return view('home.home');
    }
}

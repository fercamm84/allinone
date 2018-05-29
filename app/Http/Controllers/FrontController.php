<?php

namespace App\Http\Controllers;

use Auth;

class FrontController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

}

<?php

namespace App\Http\Controllers;

use Auth;
use App;

class StaticPageController extends AppBaseController
{

    public function __construct(){
    }

    public function location(){
        return view('static.location');
    }

}

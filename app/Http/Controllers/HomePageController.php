<?php

namespace App\Http\Controllers;

use App\Models\Section;

class HomePageController extends Controller
{

    public function __construct(){
    }

    public function index(){
        //Traer listado de "section" que tenga "section_categories" y "section_products" y esos mismos tengan "section"
        // y "category" y "section" y "product" respectivamente.
        $sections = Section::all();

        return view('home.home', array('sections' => $sections));
    }
}

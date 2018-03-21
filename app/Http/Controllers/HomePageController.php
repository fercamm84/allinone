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
        foreach($sections as $section){
            foreach($section->sectionCategories as $sectionCategory){
//                print_r($sectionCategory->section->name);
//                print_r($sectionCategory->category->description);
                foreach($sectionCategory->category->categoryProducts as $productCategory){
                    print_r($productCategory->product->name);
                }
            }
        }

        return view('home.home', array('sections' => $sections));
    }
}

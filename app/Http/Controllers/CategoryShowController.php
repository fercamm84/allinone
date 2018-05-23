<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Section;

class CategoryShowController extends Controller
{

    public function __construct(){
    }

    public function index($id = null){

        //Traer listado de "section" que tenga "section_categories" y "section_products" y esos mismos tengan "section"
        // y "category" y "section" y "product" respectivamente.
        $sections = Section::all();

        $category = Category::find($id);

        $categories = array();
        array_push($categories, $category);

        $products = array();

        foreach ($category->categoryProducts as $categoryProduct) {
            array_push($products, $categoryProduct->product);
        }

        return view('search.search', array('products' => $products, 'sections' => $sections, 'categories' => $categories));
    }
}

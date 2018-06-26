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
        $category = Category::find($id);

        $categories = array();
        array_push($categories, $category);

        $products = array();

        foreach ($category->categoryProducts as $categoryProduct) {
            array_push($products, $categoryProduct->product);
        }

        return view('search.search', array('products' => $products, 'categories' => $categories));
    }

    public function order($id = null, $orderby = null){
        $category = Category::find($id);
        return view('category.category', array('categoryProducts' => $category->categoryProducts, 'category' => $category));
    }
}

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

        $entity_parents = array();
        array_push($entity_parents, $category);

        $entity_children = array();

        foreach ($category->categoryProducts as $categoryProduct) {
            array_push($entity_children, $categoryProduct->product);
        }

        return view('search.search', array('entity_children' => $entity_children, 'entity_parents' => $entity_parents, 'category' => $category, 'categories' => $entity_parents, 'seller' => (isset($category->sellerCategories{0}->seller)) ? $category->sellerCategories{0}->seller : null));
    }

    public function order($id = null, $orderby = null){
        $category = Category::find($id);
        return view('category.category', array('categoryProducts' => $category->categoryProducts, 'category' => $category));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryShowController extends Controller
{

    public function __construct(){
    }

    public function index($id = null){
        $category = Category::find($id);

        return view('category.category', array('categoryProducts' => $category->categoryProducts));
    }
}

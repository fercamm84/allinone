<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Section;

class BrandShowController extends Controller
{

    public function __construct(){
    }

    public function index($id = null){

        $brand = Brand::find($id);

        $entity_parents = array();
        array_push($entity_parents, $brand);

        $entity_children = array();

        foreach ($brand->brandCategories as $brandCategory) {
            array_push($entity_children, $brandCategory->category);
        }

        return view('search.search', array('entity_parents' => $entity_parents, 'entity_children' => $entity_children, 'categories' => $entity_children, 'brand' => $brand));
    }

}

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
        foreach($sections as $section){
            if($section->type == 'home_principal'){
                foreach($section->sectionCategories as $sectionCategory){//tambien se puede obtener $section->sectionProducts
//                print_r($sectionCategory->section->name);//nombre de la seccion//
//                print_r($sectionCategory->category->description);//nombre de la categoria
                    foreach($sectionCategory->category->categoryProducts as $productCategory){
//                    print_r($productCategory->product->name);//nombre del producto
                        foreach($productCategory->category->imageCategories as $categoryImage){
//                            print_r($categoryImage->image->name);//src imagen del producto
                        }
                        foreach($productCategory->product->imageProducts as $productImage){
//                        print_r($productImage->image->name);//src imagen del producto
                        }
                    }
                }
            }
        }

        $category = Category::find($id);
        return view('category.category', array('categoryProducts' => $category->categoryProducts, 'sections' => $sections, 'category' => $category));
    }
}

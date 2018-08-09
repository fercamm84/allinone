<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Auth;
use App;

class SearchController extends Controller
{

    public function __construct(){
    }

    public function globalSearch(Request $request){
        $myJobPreference = null;

        $entity_children = Product::orWhere('title', 'like', '%'.$request->input('global_search').'%')->
                             orWhere('short_description', 'like','%'.$request->input('global_search').'%')->
                             orWhere('description', 'like', '%'.$request->input('global_search').'%')->
                             orWhere('name', 'like', '%'.$request->input('global_search').'%')->get();

        $entity_parents = Category::where([['description', 'like', '%'.$request->input('global_search').'%']])->get();

//        $entity_parents = array();

        foreach ($entity_children as $product) {
            foreach($product->categoryProducts as $categoryProduct){
                $encontrado = false;
                foreach($entity_parents as $category){
                    if($category->id == $categoryProduct->category->id){
                        $encontrado = true;
                        break;
                    }
                }
                if(!$encontrado){
                    array_push($entity_parents, $categoryProduct->category);
                }
            }
        }

//        return view('search.search', array('products' => $products, 'categories' => $categories));
        return view('search.search', array('entity_children' => $entity_children, 'entity_parents' => $entity_parents, 'category' => null, 'categories' => $entity_parents, 'seller' => (isset($category->sellerCategories{0}->seller)) ? $category->sellerCategories{0}->seller : null));
    }

}

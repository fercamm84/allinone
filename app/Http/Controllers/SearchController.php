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

        $products = Product::orWhere('title', 'like', '%'.$request->input('global_search').'%')->
                             orWhere('short_description', 'like','%'.$request->input('global_search').'%')->
                             orWhere('description', 'like', '%'.$request->input('global_search').'%')->
                             orWhere('name', 'like', '%'.$request->input('global_search').'%')->get();

//        $categories = Category::where([['description', 'like', '%'.$request->input('global_search').'%']])->get();

        $categories = array();

        foreach ($products as $product) {
            foreach($product->categoryProducts as $categoryProduct){
                $encontrado = false;
                foreach($categories as $category){
                    if($category->id == $categoryProduct->category->id){
                        $encontrado = true;
                        break;
                    }
                }
                if(!$encontrado){
                    array_push($categories, $categoryProduct->category);
                }
            }
        }

        return view('search.search', array('products' => $products, 'categories' => $categories));
    }

}

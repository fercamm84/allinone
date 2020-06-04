<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use App\Models\Section;
use App\Models\Location;
use Illuminate\Http\Request;
use Auth;
use App;

class SearchController extends Controller
{

    public function __construct(){
    }

    public function searchSellerByLocation($id = null){
        $selers = Seller::whereHas('entity', function($q) use ($id) {
            $q->where('location_id', $id);
        })->get();

        $entity_parents = $selers;
        
        $entity_children = array();

        $categories = array();
        $category = null;

        return view('category.category', array('entity_children' => $entity_children, 'entity_parents' => $entity_parents, 'category' => $category, 
            'categories' => $entity_parents, 'seller' => (isset($category->sellerCategories{0}->seller)) ? $category->sellerCategories{0}->seller : null));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Section;

class SellerShowController extends Controller
{

    public function __construct(){
    }

    public function index($id = null){

        $seller = Seller::find($id);

        $entity_parents = array();
        array_push($entity_parents, $seller);

        $entity_children = array();

        foreach ($seller->sellerCategories as $sellerCategory) {
            array_push($entity_children, $sellerCategory->category);
        }

        return view('search.search', array('entity_parents' => $entity_parents, 'entity_children' => $entity_children, 'categories' => $entity_children, 'seller' => $seller));
    }

}

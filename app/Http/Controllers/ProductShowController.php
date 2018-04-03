<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductShowController extends Controller
{

    public function __construct(){
    }

    public function index($id = null){
        $product = Product::find($id);

        return view('product.product', array('product' => $product));
    }

}

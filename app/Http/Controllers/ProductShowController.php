<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class ProductShowController extends Controller
{

    public function __construct(){
    }

    public function index($id = null){
        $product = Product::find($id);

        $user = Auth::user();

        $stock_solicitado = 0;
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();
        if(!empty($order)){
            $orderDetail = OrderDetail::where([['order_id', '=', $order['id']], ['product_id', '=', $id]])->first();
            $stock_solicitado = $orderDetail->volume;
        }

        return view('product.product', array('product' => $product, 'stock_solicitado' => $stock_solicitado));
    }

}

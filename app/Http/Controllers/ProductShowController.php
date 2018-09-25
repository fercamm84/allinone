<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Section;

class ProductShowController extends Controller
{

    public function __construct(){
    }

    public function index($id = null){
        $product = Product::find($id);

        $user = Auth::user();

        $stock_solicitado = 0;
/*        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();
        if(!empty($order)){
            $orderDetail = OrderDetail::where([['order_id', '=', $order['id']], ['product_id', '=', $id]])->first();
            $stock_solicitado = $orderDetail->volume;
        }
*/

        $attributes = array();
        foreach($product->entity->attributeValueEntities as $attributeValueEntity){
            array_push($attributes, $attributeValueEntity->attributeValue->attribute);
        }
        $attributes = array_unique(array_merge($attributes, $attributes), SORT_REGULAR);

//        foreach($attributes as $attribute){
//            print_r($attribute->description);
//            print_r('<BR>');
//            foreach($product->entity->attributeValueEntities as $attributeValueEntity){
//                if($attribute->id == $attributeValueEntity->attributeValue->attribute->id){
//                    print_r($attributeValueEntity->attributeValue->description);
//                    print_r($attributeValueEntity->attributeValue);
//                    print_r('<BR>');
//                }
//            }
//            print_r('<BR>');
//        }
//        die;

        return view('product.product', array('product' => $product, 'attributes' => $attributes,
            'stock_solicitado' => $stock_solicitado, 'category' => $product->categoryProducts{0}->category,
            'seller' => (isset($product->categoryProducts{0}->category->sellerCategories{0}->seller) ? $product->categoryProducts{0}->category->sellerCategories{0}->seller : null)));
    }

}

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

        $product = Product::find($id);

        $user = Auth::user();

        $stock_solicitado = 0;
/*        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();
        if(!empty($order)){
            $orderDetail = OrderDetail::where([['order_id', '=', $order['id']], ['product_id', '=', $id]])->first();
            $stock_solicitado = $orderDetail->volume;
        }
*/
        $categories = $product->categoryProducts();
        return view('product.product', array('product' => $product, 'stock_solicitado' => $stock_solicitado, 'sections' => $sections, 'category' => new Category() ));
    }

}

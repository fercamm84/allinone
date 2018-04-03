<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;

class BasketController extends Controller
{

    /** @var  OrderRepository */
    private $orderRepository;

    /** @var  OrderDetailRepository */
    private $orderDetailRepository;

    public function __construct(OrderRepository $orderRepo, OrderDetailRepository $orderDetailRepo){
        $this->orderRepository = $orderRepo;
        $this->orderDetailRepository = $orderDetailRepo;
    }

    public function add(Request $request){
        $product = Product::find($request->input('product_id'));

        //obtiene al usuario logueado
        $user = Auth::user();

        //obtengo la orden creada, sino, la creo
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();
        if(empty($order)){
            $order = array();
            $order['user_id'] = $user->id;
            $order['state'] = 1;
            $order = $this->orderRepository->create($order);
        }

        $order_detail = array();
        $order_detail['volume'] = 1;
        $order_detail['order_id'] = $order->id;
        $order_detail['product_id'] = $product->id;
        $this->orderDetailRepository->create($order_detail);

        return redirect(route('basket.index'));
    }

    public function index(){
        $user = Auth::user();

        //obtengo la orden creada
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        return view('basket.index', array('order' => $order));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Order;
use App\Models\Section;
use Illuminate\Http\Request;
use Auth;
use App;
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use SantiGraviano\LaravelMercadoPago\Facades\MP;

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

        //busco si hay un orden del mismo producto. en ese caso sumo el stock solicitado
        $orderDetail = OrderDetail::where([['order_id', '=', $order['id']], ['product_id', '=', $request->input('product_id')]])->first();

//        if($orderDetail->isEmpty()){//esto es cuando se hace un ->get(); y se quiere ver si el listado obtenido es vacio o no
        if(empty($orderDetail)){
            $orderDetail = array();
            $orderDetail['volume'] = $request->input('stock');
            $orderDetail['order_id'] = $order->id;
            $orderDetail['product_id'] = $product->id;
            $this->orderDetailRepository->create($orderDetail);
        }else{
            $orderDetail->volume = $orderDetail->volume + $request->input('stock');
            $orderDetail->save();
        }

        Flash::success('Item agregado al carrito.');

        return redirect(route('basket.index'));
    }

    public function index(){
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

        $user = Auth::user();

        //obtengo la orden creada
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        if(!empty($order) && !empty($order->orderDetails)){
            //Busco el precio total a pagar para generar la preferencia de pago:
            $total = 0;
            foreach($order->orderDetails as $orderDetail){
                $total = floatval($orderDetail->volume * $orderDetail->product->price);
            }

            //Creo preferencia de Mercadopago:
            $myJobPreference_data = array(
                "external_reference" => 'order_' . $order->id,
                "items" => array(
                    array(
                        "title" => "Utilizacion allinoneportals.tech - Orden " . $order->id,
                        "quantity" => 1,
                        "currency_id" => 'ARS',
                        "unit_price" => $total
                    )
                ),
                "back_urls" => array(
                    'success' => 'http://allinoneportals.local/' . 'basket/success',
                    'pending' => 'http://allinoneportals.local/' . 'basket/pending',
                    'failure' => 'http://allinoneportals.local/' . 'basket/failure',
                )
            );
            try
            {
                $myJobPreference = MP::create_preference($myJobPreference_data);
            }
            catch (\Exception $exc)
            {
                $myJobPreference = null;
//            throw new InternalErrorException($exc->getMessage() . ' - Order id: ' . $order->id);
            }
        }

        return view('basket.index', array('order' => $order, 'sections' => $sections, 'preference' => $myJobPreference['response']['init_point']));
    }

    public function buscarPago($valor = 0, $field = 'external_reference'){
        $filters = array (
            $field => 'order_'.$valor
        );

        return MP::search_payment($filters, 0, 1000);
    }

    public function pending(){
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

        $user = Auth::user();
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        $pago = $this->buscarPago($order->id);

        if(isset($pago['response']['results']['0']['collection']['status']) && $pago['response']['results']['0']['collection']['status']=='approved'){
            return view('basket.success', array('order' => $order, 'sections' => $sections));
        }else if(isset($pago['response']['results']['0']['collection']['status']) && $pago['response']['results']['0']['collection']['status']=='rejected'){
            Flash::error('No se pudo realizar el pago. Por favor, intente nuevamente.');
            return redirect(route('basket.index'));
        }else{
            Flash::warning('El pago se encuentra pendiente. Le informaremos cuando se haya confirmado.');
            return redirect(route('basket.index'));
        }
    }

    public function failure(){
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

        $user = Auth::user();
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        $pago = $this->buscarPago($order->id);

        if(isset($pago['response']['results']['0']['collection']['status']) && $pago['response']['results']['0']['collection']['status']=='approved'){
            return view('basket.success', array('order' => $order, 'sections' => $sections));
        }else{
            Flash::error('No se pudo realizar el pago. Por favor, intente nuevamente.');
            return redirect(route('basket.index'));
        }
    }

    public function success(){
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

        $user = Auth::user();
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        $pago = $this->buscarPago($order->id);

        if(isset($pago['response']['results']['0']['collection']['status']) && $pago['response']['results']['0']['collection']['status']=='approved'){
            //TODO: Tomar el pago y poner orden pagada!
            return view('basket.success', array('order' => $order, 'sections' => $sections));
        }else{
            Flash::error('No se pudo obtener la respuesta del pago.');
            return redirect(route('basket.index'));
        }
    }

    public function destroyOrderDetail($orderDetail_id)
    {
        $this->orderDetailRepository->delete($orderDetail_id);

        Flash::success('Item eliminado.');

//        Flash::success('Product updated successfully.');
//        Flash::error('Product not found');
//        Flash::warning('Item agregado al carrito.');

        return redirect(route('basket.index'));
    }

}

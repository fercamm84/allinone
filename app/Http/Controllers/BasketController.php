<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Section;
use Illuminate\Http\Request;
use Auth;
use App;
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\PaymentRepository;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use SantiGraviano\LaravelMercadoPago\Facades\MP;
use Illuminate\Notifications\Notifiable;

class BasketController extends FrontController
{

    /** @var  OrderRepository */
    private $orderRepository;

    /** @var  OrderDetailRepository */
    private $orderDetailRepository;

    /** @var  PaymentRepository */
    private $paymentRepository;

    public function __construct(OrderRepository $orderRepo, OrderDetailRepository $orderDetailRepo, PaymentRepository $paymentRepo){
        parent::__construct();
        $this->orderRepository = $orderRepo;
        $this->orderDetailRepository = $orderDetailRepo;
        $this->paymentRepository = $paymentRepo;
    }

    public function solicitarMercadoPago(Request $request){
        $myJobPreference = null;

        $user = Auth::user();

        //obtengo la orden creada
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        if(count($order) > 0 && count($order->orderDetails) > 0){
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
//                        "unit_price" => $total
                        "unit_price" => 1
                    )
                ),
                "back_urls" => array(
                    'success' => 'http://allinoneportals.local/' . 'basket/success',
                    'failure' => 'http://allinoneportals.local/' . 'basket/failure',
                )
            );
            try{
                $myJobPreference = MP::create_preference($myJobPreference_data);

                $payment = Payment::where([['order_id', '=', $order->id]])->first();
                if(count($payment) == 0){
                    $payment = array();
                    $payment['state'] = 'TO_PAY';
                    $payment['order_id'] = $order->id;
                    $payment['amount'] = $total;
                    $this->paymentRepository->create($payment);
                }
            }
            catch (\Exception $exc){
                $myJobPreference = null;
            }

            $arrayEnvio = array();
            $arrayEnvio = array_merge($arrayEnvio, array('preference' => $myJobPreference['response']['init_point']));
            echo json_encode($arrayEnvio);
            exit();
        }
    }

    public function paymentResult(Request $request){
        $user = Auth::user();

        if (strpos($request->input('payment_task'), 'order_')!== false){
            $order_id = str_replace("order_", "", $request->input('payment_task'));
        }

        $order = $this->orderRepository->findWithoutFail($order_id);

        $payment = Payment::where([['order_id', '=', $order->id]])->first();
        if($request->input('payment_state') != null){
            if($request->input('payment_state') == 'approved'){
                Flash::success('Compra efectuada satisfactoriamente..');
            }else if($request->input('payment_state') == 'rejected'){
                Flash::error('El pago fue rechazado. Por favor, intente nuevamente.');
            }else if($request->input('payment_state') == 'pending'){
                Flash::warning('Pago pendiente. Al completar el proceso del pago verá la transacción finalizada.');
            }
            $payment->state = $request->input('payment_state');
            $payment->save();
        }

        return redirect(route('basket.index'));
    }

    public function add(Request $request){
        $product = Product::find($request->input('product_id'));

        //obtiene al usuario logueado
        $user = Auth::user();

        //obtengo la orden creada, sino, la creo
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();
        if(count($order) == 0){
            $order = array();
            $order['user_id'] = $user->id;
            $order['state'] = 1;
            $order = $this->orderRepository->create($order);
        }

        //busco si hay un orden del mismo producto. en ese caso sumo el stock solicitado
        $orderDetail = OrderDetail::where([['order_id', '=', $order['id']], ['product_id', '=', $request->input('product_id')]])->first();

//        if($orderDetail->isEmpty()){//esto es cuando se hace un ->get(); y se quiere ver si el listado obtenido es vacio o no
        if(count($orderDetail) == 0){
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
//TODO: Con esto se envia un email:
//        $user = new App\User();
//        $user->email = 'fercamm@gmail.com';// This is the email you want to send to.
//        $user->notify(new App\Notifications\TemplateEmail());
//        die;
        $sections = Section::all();

        $user = Auth::user();

        //obtengo la orden creada
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        return view('basket.index', array('order' => $order, 'sections' => $sections));
    }

    public function buscarPago($valor = 0, $field = 'external_reference'){
        $filters = array (
            $field => 'order_'.$valor
        );

        return MP::search_payment($filters, 0, 1000);
    }

    public function pending(){
        $sections = Section::all();

        $user = Auth::user();
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        $pago = $this->buscarPago($order->id);

        $payment = Payment::where([['order_id', '=', $order->id]])->first();
        if(count($payment) > 0 && isset($pago['response']['results']['0']['collection']['status'])){
            $payment->state = $pago['response']['results']['0']['collection']['status'];
            $payment->save();
        }

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

        $user = Auth::user();
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        $pago = $this->buscarPago($order->id);

        $payment = Payment::where([['order_id', '=', $order->id]])->first();
        if(count($payment) > 0 && isset($pago['response']['results']['0']['collection']['status'])){
            $payment->state = $pago['response']['results']['0']['collection']['status'];
            $payment->save();
        }

        if(isset($pago['response']['results']['0']['collection']['status']) && $pago['response']['results']['0']['collection']['status']=='approved'){
            return view('basket.success', array('order' => $order, 'sections' => $sections));
        }else{
            Flash::error('No se pudo realizar el pago. Por favor, intente nuevamente.');
            return redirect(route('basket.index'));
        }
    }

    public function success(){
        $sections = Section::all();

        $user = Auth::user();
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        $pago = $this->buscarPago($order->id);

        $payment = Payment::where(['order_id', '=', $order->id])->first();
        if(count($payment) > 0 && isset($pago['response']['results']['0']['collection']['status'])){
            $payment->state = $pago['response']['results']['0']['collection']['status'];
            $payment->save();
        }

        if(isset($pago['response']['results']['0']['collection']['status']) && $pago['response']['results']['0']['collection']['status']=='approved'){
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

    public function history(){
        $sections = Section::all();

        $user = Auth::user();

        //obtengo la orden creada
        $orders = Order::where([['user_id', '=', $user->id], ['state', '<>', 1]])->get();

        return view('basket.history', array('orders' => $orders, 'sections' => $sections));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\SellerDay;
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
use App\Repositories\OrderDetailAttributeValueEntityRepository;
use App\Repositories\SellerReservationRepository;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
// use SantiGraviano\LaravelMercadoPago\Facades\MP;
use Illuminate\Notifications\Notifiable;
use MercadoPago;
class BasketController extends FrontController
{

    /** @var  OrderRepository */
    private $orderRepository;

    /** @var  OrderDetailRepository */
    private $orderDetailRepository;

    /** @var  PaymentRepository */
    private $paymentRepository;

    /** @var  OrderDetailAttributeValueEntityRepository */
    private $orderDetailAttributeValueEntityRepository;

    /** @var  SellerReservationRepository */
    private $sellerReservationRepository;

    public function __construct(OrderRepository $orderRepo, OrderDetailRepository $orderDetailRepo, PaymentRepository $paymentRepo, OrderDetailAttributeValueEntityRepository $orderDetailAttributeValueEntityRepo, SellerReservationRepository $sellerReservationRepo){
        parent::__construct();
        $this->orderRepository = $orderRepo;
        $this->orderDetailRepository = $orderDetailRepo;
        $this->paymentRepository = $paymentRepo;
        $this->orderDetailAttributeValueEntityRepository = $orderDetailAttributeValueEntityRepo;
        $this->sellerReservationRepository = $sellerReservationRepo;
    }

    public function solicitarMercadoPago(Request $request){
        $user = Auth::user();

        //obtengo la orden creada
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        if($order && count($order->orderDetails) > 0){
            //Busco el precio total a pagar para generar la preferencia de pago:
            $total = $order->total();

            MercadoPago\SDK::setClientId(env('MP_APP_ID'));
            MercadoPago\SDK::setClientSecret(env('MP_APP_SECRET'));
    
            # Create a preference object
            $preference = new MercadoPago\Preference();
            # Create an item object
            $item = new MercadoPago\Item();
            // $item->id = "1234";
            $item->title = "Utilizacion allinoneportals.tech - Orden " . $order->id;
            $item->quantity = 1;
            $item->currency_id = "ARS";
            $item->unit_price = $total;
            # Create a payer object
            // $payer = new MercadoPago\Payer();
            // $payer->email = "rosemarie@hotmail.com";
            # Setting preference properties
            $preference->items = array($item);
            // $preference->payer = $payer;
            # Save and posting preference
            $preference->save();

            $payment = Payment::where([['order_id', '=', $order->id]])->first();
            if(!$payment){
                $payment = array();
                $payment['state'] = 'TO_PAY';
                $payment['order_id'] = $order->id;
                $payment['amount'] = $total;
                $this->paymentRepository->create($payment);
            }

            $arrayEnvio = array();
            $arrayEnvio = array_merge($arrayEnvio, array('preference' => $preference->init_point));
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
                Flash::success('Compra efectuada satisfactoriamente.');
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

        $stock = $request->input('stock');
        if($stock == null){
            $stock = $request->input('number_of_reservations');
        }

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
        if(empty($orderDetail) || !empty($request->input('fecha_reserva'))){//si es una reserva (seller) se crea siempre una nueva orden porque cambia el horario
            $orderDetail = array();
            $orderDetail['volume'] = $stock;
            $orderDetail['order_id'] = $order->id;
            $orderDetail['product_id'] = $product->id;
            $orderDetail = $this->orderDetailRepository->create($orderDetail);
        }else{
            $orderDetail->volume = $orderDetail->volume + $stock;
            $orderDetail->save();
        }

        $attributes = array();
        foreach($product->entity->attributeValueEntities as $attributeValueEntity){
            array_push($attributes, $attributeValueEntity->attributeValue->attribute);
        }
        $attributes = array_unique(array_merge($attributes, $attributes), SORT_REGULAR);

        foreach($attributes as $attribute){
            $attribute_value_entity_id = $request->input('attr_'.$attribute->id);

            $orderDetailAttributeValueEntity = array();
            $orderDetailAttributeValueEntity['order_detail_id'] = $orderDetail->id;
            $orderDetailAttributeValueEntity['attribute_value_entity_id'] = $attribute_value_entity_id;
            $this->orderDetailAttributeValueEntityRepository->create($orderDetailAttributeValueEntity);
        }

        //Solamente cuando se hace la reserva en un seller:
        if(!empty($request->input('fecha_reserva'))){
            $fecha_reserva = $request->input('fecha_reserva');
            $dia_reserva = (new \DateTime($fecha_reserva))->format('Y-m-d');
            $hora_reserva = intval((new \DateTime($fecha_reserva))->format('H'));

            $seller_id = $request->input('seller_id');

            $stock = $request->input('number_of_reservations');

            $sellerDay = SellerDay::where([['seller_id', '=', $seller_id], ['date', '=', $dia_reserva], ['from_hour', '<=', $hora_reserva], ['to_hour', '>', $hora_reserva], ['available', '=', 1]])->first();

            $sellerReservation = array();
            $sellerReservation['seller_day_id'] = $sellerDay->id;
            $sellerReservation['user_id'] = $user->id;
            $sellerReservation['total'] = $stock;
            $sellerReservation['from_hour'] = $hora_reserva;
            $sellerReservation['order_detail_id'] = $orderDetail->id;

            $sellerReservation = $this->sellerReservationRepository->create($sellerReservation);
        }

        Flash::success('Item agregado al carrito.');

        return redirect(route('basket.index'));
    }

    public function index(){
        $user = Auth::user();

        //obtengo la orden creada
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        return view('basket.index', array('order' => $order));
    }

    public function buscarPago($valor = 0, $field = 'external_reference'){
        $filters = array (
            $field => 'order_'.$valor
        );

        return MP::search_payment($filters, 0, 1000);
    }

    public function pending(){
        $user = Auth::user();
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        $pago = $this->buscarPago($order->id);

        $payment = Payment::where([['order_id', '=', $order->id]])->first();
        if($payment && isset($pago['response']['results']['0']['collection']['status'])){
            $payment->state = $pago['response']['results']['0']['collection']['status'];
            $payment->save();
        }

        if(isset($pago['response']['results']['0']['collection']['status']) && $pago['response']['results']['0']['collection']['status']=='approved'){
            return view('basket.success', array('order' => $order));
        }else if(isset($pago['response']['results']['0']['collection']['status']) && $pago['response']['results']['0']['collection']['status']=='rejected'){
            Flash::error('No se pudo realizar el pago. Por favor, intente nuevamente.');
            return redirect(route('basket.index'));
        }else{
            Flash::warning('El pago se encuentra pendiente. Le informaremos cuando se haya confirmado.');
            return redirect(route('basket.index'));
        }
    }

    public function failure(){
        $user = Auth::user();
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        $pago = $this->buscarPago($order->id);

        $payment = Payment::where([['order_id', '=', $order->id]])->first();
        if($payment && isset($pago['response']['results']['0']['collection']['status'])){
            $payment->state = $pago['response']['results']['0']['collection']['status'];
            $payment->save();
        }

        if(isset($pago['response']['results']['0']['collection']['status']) && $pago['response']['results']['0']['collection']['status']=='approved'){
            return view('basket.success', array('order' => $order));
        }else{
            Flash::error('No se pudo realizar el pago. Por favor, intente nuevamente.');
            return redirect(route('basket.index'));
        }
    }

    public function success(){
        $user = Auth::user();
        $order = Order::where([['user_id', '=', $user->id], ['state', '=', 1]])->first();

        $pago = $this->buscarPago($order->id);

        $payment = Payment::where(['order_id', '=', $order->id])->first();
        if(count($payment) > 0 && isset($pago['response']['results']['0']['collection']['status'])){
            $payment->state = $pago['response']['results']['0']['collection']['status'];
            $payment->save();
        }

        if(isset($pago['response']['results']['0']['collection']['status']) && $pago['response']['results']['0']['collection']['status']=='approved'){
            return view('basket.success', array('order' => $order));
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
        $user = Auth::user();

        //obtengo la orden creada
        $orders = Order::where([['user_id', '=', $user->id], ['state', '<>', 1]])->get();

        return view('basket.history', array('orders' => $orders));
    }

}

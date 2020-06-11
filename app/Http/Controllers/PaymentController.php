<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use MercadoPago;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Process;
use App\Jobs\SendEmail;

class PaymentController extends AppBaseController
{
    /** @var  PaymentRepository */
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepo)
    {
        $this->paymentRepository = $paymentRepo;
    }

    /**
     * Display a listing of the Payment.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->paymentRepository->pushCriteria(new RequestCriteria($request));
        $payments = $this->paymentRepository->all();

        return view('payments.index')
            ->with('payments', $payments);
    }

    /**
     * Show the form for creating a new Payment.
     *
     * @return Response
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Store a newly created Payment in storage.
     *
     * @param CreatePaymentRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentRequest $request)
    {
        $input = $request->all();

        $payment = $this->paymentRepository->create($input);

        Flash::success('Payment saved successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Display the specified Payment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.show')->with('payment', $payment);
    }

    /**
     * Show the form for editing the specified Payment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.edit')->with('payment', $payment);
    }

    /**
     * Update the specified Payment in storage.
     *
     * @param  int              $id
     * @param UpdatePaymentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $payment = $this->paymentRepository->update($request->all(), $id);

        Flash::success('Payment updated successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Remove the specified Payment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $this->paymentRepository->delete($id);

        Flash::success('Payment deleted successfully.');

        return redirect(route('payments.index'));
    }

    public function getPayments(){
        try {
            MercadoPago\SDK::setClientId(env('MP_APP_ID'));
            MercadoPago\SDK::setClientSecret(env('MP_APP_SECRET'));
            $filters = array (
                'id' => $_GET['id']
            );
            $pago = MercadoPago\Payment::search($filters);
            if(count($pago)){
                $pago = $pago[0];
            }else{
                print_r('No hay datos.');
                die;
            }
            // print_r($pago);
            // die;

            // //Se obtiene el pago desde MercadoPago segun el ID recibido por parametro por MercadoPago
            // $pago = (new MercadoPago\Payment())->find_by_id($_GET['id']);
            // MercadoPago\Payment.find_by_id($_GET['id']);
        }catch (Exception $exc){
            header("HTTP/1.1 200 OK");
            http_response_code(200);
            die;
        }

        //Se obtienen los valores del pago.
        $status = $pago->status;
        $merchant_order_id = $pago->order->id;
        $total_paid_amount = $pago->transaction_details->total_paid_amount;
        $status_detail = $pago->status_detail;
        $payment_type = $pago->payment_type_id;
        $operation_type = $pago->operation_type;
        $payment_id = $pago->id;
        $external_reference = $pago->external_reference;
        $order_id = $external_reference;
        $order_id = intval(str_replace('Order_', '', $order_id));

        $payment = Payment::where([['order_id', '=', $order_id]])->first();

        if($payment){
            $payment->state = $status;
            $payment->merchant_order_id = $merchant_order_id;
            $payment->total_paid_amount = $total_paid_amount;
            $payment->status_detail = $status_detail;
            $payment->payment_type = $payment_type;
            $payment->operation_type = $operation_type;
            $payment->payment_id = $payment_id;
            $payment->order_id = $order_id;
            $payment->save();
        }else{
            $payment = new Payment;
            $payment->state = $status;
            $payment->merchant_order_id = $merchant_order_id;
            $payment->total_paid_amount = $total_paid_amount;
            $payment->status_detail = $status_detail;
            $payment->payment_type = $payment_type;
            $payment->operation_type = $operation_type;
            $payment->payment_id = $payment_id;
            $payment->order_id = $order_id;
            $this->paymentRepository->create($payment);
        }

        $order = Order::find($payment->order_id);
        if($payment->state == 'approved'){
            $order->state = 2;
            $order->save();

            //Envio mail a cada seller de la orden de compra para avisarle que tiene una venta:
            $sellerUsers = array();
            foreach($order->orderDetails as $orderDetail){
                $existe = false;
                foreach($sellerUsers as $sellerUserId){
                    if($sellerUserId == $orderDetail->product->seller->user->id){
                        $existe = true;
                        break;
                    }
                }
                if(!$existe){
                    array_push($sellerUsers, $orderDetail->product->seller->user->id);
                }
            }
            foreach($sellerUsers as $sellerUserId){
                //creo el objeto process
                $process = new Process;
                $process->user_id = $sellerUserId;
                $process->process = 'successfulSale';
                $process->comment = 'Order_' . $order->id;
                //Genero el job para enviar el process (por email)
                SendEmail::dispatch($process);
            }
        }

        //creo el objeto process para enviarle al cliente que pudo realizar la compra:
        $process = new Process;
        $process->user_id = $user->id;
        $process->process = 'paymentProcessed';
        $process->comment = 'Order_' . $order->id;
        //Genero el job para enviar el process (por email)
        SendEmail::dispatch($process);

        print_r($payment->order_id);

        die;
    }

}

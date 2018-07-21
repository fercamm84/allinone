<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;
use App\Models\Payment;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use SantiGraviano\LaravelMercadoPago\Facades\MP;

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
            //Se obtiene el pago desde MercadoPago segun el ID recibido por parametro por MercadoPago
//            $pago = MP::get_payment(3662769330);
            $pago = MP::get_payment($_GET['id']);
        }catch (\Exception $exc){
            die;
        }

        //Se obtienen los valores del pago.
        $status = $pago['response']['collection']['status'];
        $merchant_order_id = $pago['response']['collection']['merchant_order_id'];
        $total_paid_amount = $pago['response']['collection']['transaction_amount'];
        $status_detail = $pago['response']['collection']['status_detail'];
        $payment_type = $pago['response']['collection']['payment_type'];
        $operation_type = $pago['response']['collection']['operation_type'];
        $payment_id = $pago['response']['collection']['id'];
        $external_reference = $pago['response']['collection']['external_reference'];
        $order_id = $external_reference;
        $order_id = intval(str_replace('order_', '', $order_id));

        $payment = Payment::where([['order_id', '=', $order_id]])->first();

        if(count($payment) > 0){
            $payment->state = $status;
            $payment->merchant_order_id = $merchant_order_id;
            $payment->total_paid_amount = $total_paid_amount;
            $payment->status_detail = $status_detail;
            $payment->payment_type = $payment_type;
            $payment->operation_type = $operation_type;
            $payment->payment_id = $payment_id;
            $payment->order_id = $order_id;
            $payment->save();
        }

        print_r($payment);

        die;
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderDetailAttributeValueRequest;
use App\Http\Requests\UpdateOrderDetailAttributeValueRequest;
use App\Repositories\OrderDetailAttributeValueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class OrderDetailAttributeValueController extends AppBaseController
{
    /** @var  OrderDetailAttributeValueRepository */
    private $orderDetailAttributeValueRepository;

    public function __construct(OrderDetailAttributeValueRepository $orderDetailAttributeValueRepo)
    {
        $this->orderDetailAttributeValueRepository = $orderDetailAttributeValueRepo;
    }

    /**
     * Display a listing of the OrderDetailAttributeValue.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->orderDetailAttributeValueRepository->pushCriteria(new RequestCriteria($request));
        $orderDetailAttributeValues = $this->orderDetailAttributeValueRepository->all();

        return view('order_detail_attribute_values.index')
            ->with('orderDetailAttributeValues', $orderDetailAttributeValues);
    }

    /**
     * Show the form for creating a new OrderDetailAttributeValue.
     *
     * @return Response
     */
    public function create()
    {
        return view('order_detail_attribute_values.create');
    }

    /**
     * Store a newly created OrderDetailAttributeValue in storage.
     *
     * @param CreateOrderDetailAttributeValueRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderDetailAttributeValueRequest $request)
    {
        $input = $request->all();

        $orderDetailAttributeValue = $this->orderDetailAttributeValueRepository->create($input);

        Flash::success('Order Detail Attribute Value saved successfully.');

        return redirect(route('orderDetailAttributeValues.index'));
    }

    /**
     * Display the specified OrderDetailAttributeValue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderDetailAttributeValue = $this->orderDetailAttributeValueRepository->findWithoutFail($id);

        if (empty($orderDetailAttributeValue)) {
            Flash::error('Order Detail Attribute Value not found');

            return redirect(route('orderDetailAttributeValues.index'));
        }

        return view('order_detail_attribute_values.show')->with('orderDetailAttributeValue', $orderDetailAttributeValue);
    }

    /**
     * Show the form for editing the specified OrderDetailAttributeValue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderDetailAttributeValue = $this->orderDetailAttributeValueRepository->findWithoutFail($id);

        if (empty($orderDetailAttributeValue)) {
            Flash::error('Order Detail Attribute Value not found');

            return redirect(route('orderDetailAttributeValues.index'));
        }

        return view('order_detail_attribute_values.edit')->with('orderDetailAttributeValue', $orderDetailAttributeValue);
    }

    /**
     * Update the specified OrderDetailAttributeValue in storage.
     *
     * @param  int              $id
     * @param UpdateOrderDetailAttributeValueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderDetailAttributeValueRequest $request)
    {
        $orderDetailAttributeValue = $this->orderDetailAttributeValueRepository->findWithoutFail($id);

        if (empty($orderDetailAttributeValue)) {
            Flash::error('Order Detail Attribute Value not found');

            return redirect(route('orderDetailAttributeValues.index'));
        }

        $orderDetailAttributeValue = $this->orderDetailAttributeValueRepository->update($request->all(), $id);

        Flash::success('Order Detail Attribute Value updated successfully.');

        return redirect(route('orderDetailAttributeValues.index'));
    }

    /**
     * Remove the specified OrderDetailAttributeValue from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderDetailAttributeValue = $this->orderDetailAttributeValueRepository->findWithoutFail($id);

        if (empty($orderDetailAttributeValue)) {
            Flash::error('Order Detail Attribute Value not found');

            return redirect(route('orderDetailAttributeValues.index'));
        }

        $this->orderDetailAttributeValueRepository->delete($id);

        Flash::success('Order Detail Attribute Value deleted successfully.');

        return redirect(route('orderDetailAttributeValues.index'));
    }
}

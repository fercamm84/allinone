<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderDetailAttributeValueEntityRequest;
use App\Http\Requests\UpdateOrderDetailAttributeValueEntityRequest;
use App\Repositories\OrderDetailAttributeValueEntityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class OrderDetailAttributeValueEntityController extends AppBaseController
{
    /** @var  OrderDetailAttributeValueEntityRepository */
    private $orderDetailAttributeValueEntityRepository;

    public function __construct(OrderDetailAttributeValueEntityRepository $orderDetailAttributeValueEntityRepo)
    {
        $this->orderDetailAttributeValueEntityRepository = $orderDetailAttributeValueEntityRepo;
    }

    /**
     * Display a listing of the OrderDetailAttributeValueEntity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->orderDetailAttributeValueEntityRepository->pushCriteria(new RequestCriteria($request));
        $orderDetailAttributeValueEntities = $this->orderDetailAttributeValueEntityRepository->all();

        return view('order_detail_attribute_value_entities.index')
            ->with('orderDetailAttributeValueEntities', $orderDetailAttributeValueEntities);
    }

    /**
     * Show the form for creating a new OrderDetailAttributeValueEntity.
     *
     * @return Response
     */
    public function create()
    {
        return view('order_detail_attribute_value_entities.create');
    }

    /**
     * Store a newly created OrderDetailAttributeValueEntity in storage.
     *
     * @param CreateOrderDetailAttributeValueEntityRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderDetailAttributeValueEntityRequest $request)
    {
        $input = $request->all();

        $orderDetailAttributeValueEntity = $this->orderDetailAttributeValueEntityRepository->create($input);

        Flash::success('Order Detail Attribute Value Entity saved successfully.');

        return redirect(route('orderDetailAttributeValueEntities.index'));
    }

    /**
     * Display the specified OrderDetailAttributeValueEntity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderDetailAttributeValueEntity = $this->orderDetailAttributeValueEntityRepository->findWithoutFail($id);

        if (empty($orderDetailAttributeValueEntity)) {
            Flash::error('Order Detail Attribute Value Entity not found');

            return redirect(route('orderDetailAttributeValueEntities.index'));
        }

        return view('order_detail_attribute_value_entities.show')->with('orderDetailAttributeValueEntity', $orderDetailAttributeValueEntity);
    }

    /**
     * Show the form for editing the specified OrderDetailAttributeValueEntity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderDetailAttributeValueEntity = $this->orderDetailAttributeValueEntityRepository->findWithoutFail($id);

        if (empty($orderDetailAttributeValueEntity)) {
            Flash::error('Order Detail Attribute Value Entity not found');

            return redirect(route('orderDetailAttributeValueEntities.index'));
        }

        return view('order_detail_attribute_value_entities.edit')->with('orderDetailAttributeValueEntity', $orderDetailAttributeValueEntity);
    }

    /**
     * Update the specified OrderDetailAttributeValueEntity in storage.
     *
     * @param  int              $id
     * @param UpdateOrderDetailAttributeValueEntityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderDetailAttributeValueEntityRequest $request)
    {
        $orderDetailAttributeValueEntity = $this->orderDetailAttributeValueEntityRepository->findWithoutFail($id);

        if (empty($orderDetailAttributeValueEntity)) {
            Flash::error('Order Detail Attribute Value Entity not found');

            return redirect(route('orderDetailAttributeValueEntities.index'));
        }

        $orderDetailAttributeValueEntity = $this->orderDetailAttributeValueEntityRepository->update($request->all(), $id);

        Flash::success('Order Detail Attribute Value Entity updated successfully.');

        return redirect(route('orderDetailAttributeValueEntities.index'));
    }

    /**
     * Remove the specified OrderDetailAttributeValueEntity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderDetailAttributeValueEntity = $this->orderDetailAttributeValueEntityRepository->findWithoutFail($id);

        if (empty($orderDetailAttributeValueEntity)) {
            Flash::error('Order Detail Attribute Value Entity not found');

            return redirect(route('orderDetailAttributeValueEntities.index'));
        }

        $this->orderDetailAttributeValueEntityRepository->delete($id);

        Flash::success('Order Detail Attribute Value Entity deleted successfully.');

        return redirect(route('orderDetailAttributeValueEntities.index'));
    }
}

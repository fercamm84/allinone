<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSellerDayRequest;
use App\Http\Requests\UpdateSellerDayRequest;
use App\Repositories\SellerDayRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SellerDayController extends AppBaseController
{
    /** @var  SellerDayRepository */
    private $sellerDayRepository;

    public function __construct(SellerDayRepository $sellerDayRepo)
    {
        $this->sellerDayRepository = $sellerDayRepo;
    }

    /**
     * Display a listing of the SellerDay.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sellerDayRepository->pushCriteria(new RequestCriteria($request));
        $sellerDays = $this->sellerDayRepository->all();

        return view('seller_days.index')
            ->with('sellerDays', $sellerDays);
    }

    /**
     * Show the form for creating a new SellerDay.
     *
     * @return Response
     */
    public function create()
    {
        return view('seller_days.create');
    }

    /**
     * Store a newly created SellerDay in storage.
     *
     * @param CreateSellerDayRequest $request
     *
     * @return Response
     */
    public function store(CreateSellerDayRequest $request)
    {
        $input = $request->all();

        $sellerDay = $this->sellerDayRepository->create($input);

        Flash::success('Seller Day saved successfully.');

        return redirect(route('sellerDays.index'));
    }

    /**
     * Display the specified SellerDay.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sellerDay = $this->sellerDayRepository->findWithoutFail($id);

        if (empty($sellerDay)) {
            Flash::error('Seller Day not found');

            return redirect(route('sellerDays.index'));
        }

        return view('seller_days.show')->with('sellerDay', $sellerDay);
    }

    /**
     * Show the form for editing the specified SellerDay.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sellerDay = $this->sellerDayRepository->findWithoutFail($id);

        if (empty($sellerDay)) {
            Flash::error('Seller Day not found');

            return redirect(route('sellerDays.index'));
        }

        return view('seller_days.edit')->with('sellerDay', $sellerDay);
    }

    /**
     * Update the specified SellerDay in storage.
     *
     * @param  int              $id
     * @param UpdateSellerDayRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSellerDayRequest $request)
    {
        $sellerDay = $this->sellerDayRepository->findWithoutFail($id);

        if (empty($sellerDay)) {
            Flash::error('Seller Day not found');

            return redirect(route('sellerDays.index'));
        }

        $sellerDay = $this->sellerDayRepository->update($request->all(), $id);

        Flash::success('Seller Day updated successfully.');

        return redirect(route('sellerDays.index'));
    }

    /**
     * Remove the specified SellerDay from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sellerDay = $this->sellerDayRepository->findWithoutFail($id);

        if (empty($sellerDay)) {
            Flash::error('Seller Day not found');

            return redirect(route('sellerDays.index'));
        }

        $this->sellerDayRepository->delete($id);

        Flash::success('Seller Day deleted successfully.');

        return redirect(route('sellerDays.index'));
    }
}

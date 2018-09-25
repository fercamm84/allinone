<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSellerReservationRequest;
use App\Http\Requests\UpdateSellerReservationRequest;
use App\Repositories\SellerReservationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SellerReservationController extends AppBaseController
{
    /** @var  SellerReservationRepository */
    private $sellerReservationRepository;

    public function __construct(SellerReservationRepository $sellerReservationRepo)
    {
        $this->sellerReservationRepository = $sellerReservationRepo;
    }

    /**
     * Display a listing of the SellerReservation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sellerReservationRepository->pushCriteria(new RequestCriteria($request));
        $sellerReservations = $this->sellerReservationRepository->all();

        return view('seller_reservations.index')
            ->with('sellerReservations', $sellerReservations);
    }

    /**
     * Show the form for creating a new SellerReservation.
     *
     * @return Response
     */
    public function create()
    {
        return view('seller_reservations.create');
    }

    /**
     * Store a newly created SellerReservation in storage.
     *
     * @param CreateSellerReservationRequest $request
     *
     * @return Response
     */
    public function store(CreateSellerReservationRequest $request)
    {
        $input = $request->all();

        $sellerReservation = $this->sellerReservationRepository->create($input);

        Flash::success('Seller Reservation saved successfully.');

        return redirect(route('sellerReservations.index'));
    }

    /**
     * Display the specified SellerReservation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sellerReservation = $this->sellerReservationRepository->findWithoutFail($id);

        if (empty($sellerReservation)) {
            Flash::error('Seller Reservation not found');

            return redirect(route('sellerReservations.index'));
        }

        return view('seller_reservations.show')->with('sellerReservation', $sellerReservation);
    }

    /**
     * Show the form for editing the specified SellerReservation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sellerReservation = $this->sellerReservationRepository->findWithoutFail($id);

        if (empty($sellerReservation)) {
            Flash::error('Seller Reservation not found');

            return redirect(route('sellerReservations.index'));
        }

        return view('seller_reservations.edit')->with('sellerReservation', $sellerReservation);
    }

    /**
     * Update the specified SellerReservation in storage.
     *
     * @param  int              $id
     * @param UpdateSellerReservationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSellerReservationRequest $request)
    {
        $sellerReservation = $this->sellerReservationRepository->findWithoutFail($id);

        if (empty($sellerReservation)) {
            Flash::error('Seller Reservation not found');

            return redirect(route('sellerReservations.index'));
        }

        $sellerReservation = $this->sellerReservationRepository->update($request->all(), $id);

        Flash::success('Seller Reservation updated successfully.');

        return redirect(route('sellerReservations.index'));
    }

    /**
     * Remove the specified SellerReservation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sellerReservation = $this->sellerReservationRepository->findWithoutFail($id);

        if (empty($sellerReservation)) {
            Flash::error('Seller Reservation not found');

            return redirect(route('sellerReservations.index'));
        }

        $this->sellerReservationRepository->delete($id);

        Flash::success('Seller Reservation deleted successfully.');

        return redirect(route('sellerReservations.index'));
    }
}

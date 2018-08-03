<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Repositories\SellerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SellerController extends AppBaseController
{
    /** @var  SellerRepository */
    private $sellerRepository;

    public function __construct(SellerRepository $sellerRepo)
    {
        $this->sellerRepository = $sellerRepo;
    }

    /**
     * Display a listing of the Seller.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sellerRepository->pushCriteria(new RequestCriteria($request));
        $sellers = $this->sellerRepository->all();

        return view('sellers.index')
            ->with('sellers', $sellers);
    }

    /**
     * Show the form for creating a new Seller.
     *
     * @return Response
     */
    public function create()
    {
        return view('sellers.create');
    }

    /**
     * Store a newly created Seller in storage.
     *
     * @param CreateSellerRequest $request
     *
     * @return Response
     */
    public function store(CreateSellerRequest $request)
    {
        $input = $request->all();

        $seller = $this->sellerRepository->create($input);

        Flash::success('Seller saved successfully.');

        return redirect(route('sellers.index'));
    }

    /**
     * Display the specified Seller.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $seller = $this->sellerRepository->findWithoutFail($id);

        if (empty($seller)) {
            Flash::error('Seller not found');

            return redirect(route('sellers.index'));
        }

        return view('sellers.show')->with('seller', $seller);
    }

    /**
     * Show the form for editing the specified Seller.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $seller = $this->sellerRepository->findWithoutFail($id);

        if (empty($seller)) {
            Flash::error('Seller not found');

            return redirect(route('sellers.index'));
        }

        return view('sellers.edit')->with('seller', $seller);
    }

    /**
     * Update the specified Seller in storage.
     *
     * @param  int              $id
     * @param UpdateSellerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSellerRequest $request)
    {
        $seller = $this->sellerRepository->findWithoutFail($id);

        if (empty($seller)) {
            Flash::error('Seller not found');

            return redirect(route('sellers.index'));
        }

        $seller = $this->sellerRepository->update($request->all(), $id);

        Flash::success('Seller updated successfully.');

        return redirect(route('sellers.index'));
    }

    /**
     * Remove the specified Seller from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $seller = $this->sellerRepository->findWithoutFail($id);

        if (empty($seller)) {
            Flash::error('Seller not found');

            return redirect(route('sellers.index'));
        }

        $this->sellerRepository->delete($id);

        Flash::success('Seller deleted successfully.');

        return redirect(route('sellers.index'));
    }
}

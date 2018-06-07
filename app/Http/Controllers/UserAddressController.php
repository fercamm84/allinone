<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use App\Repositories\UserAddressRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserAddressController extends AppBaseController
{
    /** @var  UserAddressRepository */
    private $userAddressRepository;

    public function __construct(UserAddressRepository $userAddressRepo)
    {
        $this->userAddressRepository = $userAddressRepo;
    }

    /**
     * Display a listing of the UserAddress.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userAddressRepository->pushCriteria(new RequestCriteria($request));
        $userAddresses = $this->userAddressRepository->all();

        return view('user_addresses.index')
            ->with('userAddresses', $userAddresses);
    }

    /**
     * Show the form for creating a new UserAddress.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_addresses.create');
    }

    /**
     * Store a newly created UserAddress in storage.
     *
     * @param CreateUserAddressRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAddressRequest $request)
    {
        $input = $request->all();

        $userAddress = $this->userAddressRepository->create($input);

        Flash::success('User Address saved successfully.');

        return redirect(route('userAddresses.index'));
    }

    /**
     * Display the specified UserAddress.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userAddress = $this->userAddressRepository->findWithoutFail($id);

        if (empty($userAddress)) {
            Flash::error('User Address not found');

            return redirect(route('userAddresses.index'));
        }

        return view('user_addresses.show')->with('userAddress', $userAddress);
    }

    /**
     * Show the form for editing the specified UserAddress.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userAddress = $this->userAddressRepository->findWithoutFail($id);

        if (empty($userAddress)) {
            Flash::error('User Address not found');

            return redirect(route('userAddresses.index'));
        }

        return view('user_addresses.edit')->with('userAddress', $userAddress);
    }

    /**
     * Update the specified UserAddress in storage.
     *
     * @param  int              $id
     * @param UpdateUserAddressRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAddressRequest $request)
    {
        $userAddress = $this->userAddressRepository->findWithoutFail($id);

        if (empty($userAddress)) {
            Flash::error('User Address not found');

            return redirect(route('userAddresses.index'));
        }

        $userAddress = $this->userAddressRepository->update($request->all(), $id);

        Flash::success('User Address updated successfully.');

        return redirect(route('userAddresses.index'));
    }

    /**
     * Remove the specified UserAddress from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userAddress = $this->userAddressRepository->findWithoutFail($id);

        if (empty($userAddress)) {
            Flash::error('User Address not found');

            return redirect(route('userAddresses.index'));
        }

        $this->userAddressRepository->delete($id);

        Flash::success('User Address deleted successfully.');

        return redirect(route('userAddresses.index'));
    }
}

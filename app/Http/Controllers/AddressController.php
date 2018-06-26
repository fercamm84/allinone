<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\Models\Location;
use App\Models\Section;
use App\Models\UserAddress;
use App\Models\Zone;
use App\Repositories\AddressRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserAddressRepository;
use Illuminate\Http\Request;
use Flash;
use Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AddressController extends AppBaseController
{
    /** @var  AddressRepository */
    private $addressRepository;

    /** @var  UserAddressRepository */
    private $userAddressRepository;

    public function __construct(AddressRepository $addressRepo, UserAddressRepository $userAddressRepo)
    {
        $this->addressRepository = $addressRepo;
        $this->userAddressRepository = $userAddressRepo;
    }

    /**
     * Display a listing of the Address.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $userAddresses = UserAddress::where([['user_id', '=', $user->id]])->get();

        return view('address.list', array('userAddresses' => $userAddresses));
    }

    /**
     * Show the form for creating a new Address.
     *
     * @return Response
     */
    public function create()
    {
        $zones = Zone::where('country_id','=',1)->get()->pluck('description', 'id');
        $cities = array();
        $locations = array();

        return view('address.create', array('locations' => $locations, 'cities' => $cities, 'zones' => $zones));
    }

    /**
     * Store a newly created Address in storage.
     *
     * @param CreateAddressRequest $request
     *
     * @return Response
     */
    public function store(CreateAddressRequest $request)
    {
        $input = $request->all();

        $address = $this->addressRepository->create($input);

        $user = Auth::user();

        $userAddress = array();
        $userAddress['user_id'] = $user->id;
        $userAddress['address_id'] = $address->id;
        $this->userAddressRepository->create($userAddress);

        Flash::success('Address saved successfully.');

        return redirect(route('address.index'));
    }

    /**
     * Display the specified Address.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $address = $this->addressRepository->findWithoutFail($id);

        if (empty($address)) {
            Flash::error('Address not found');

            return redirect(route('address.index'));
        }

        return view('address.show')->with('address', $address);
    }

    /**
     * Show the form for editing the specified Address.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $address = $this->addressRepository->findWithoutFail($id);

        $zones = Zone::where('country_id','=',$address->location->city->zone->country->id)->get()->pluck('description', 'id');
        $cities = City::where('zone_id','=',$address->location->city->zone->id)->get()->pluck('description', 'id');
        $locations = Location::where('city_id','=',$address->location->city->id)->get()->pluck('description', 'id');

        if (empty($address)) {
            Flash::error('Address not found');

            return redirect(route('address.index'));
        }

        return view('address.edit', array('address' => $address, 'locations' => $locations,
            'cities' => $cities, 'zones' => $zones));
    }

    /**
     * Update the specified Address in storage.
     *
     * @param  int              $id
     * @param UpdateAddressRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAddressRequest $request)
    {
        $address = $this->addressRepository->findWithoutFail($id);

        if (empty($address)) {
            Flash::error('Address not found');

            return redirect(route('address.index'));
        }

        $address = $this->addressRepository->update($request->all(), $id);

        Flash::success('Address updated successfully.');

        return redirect(route('address.index'));
    }

    /**
     * Remove the specified Address from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $address = $this->addressRepository->findWithoutFail($id);

        if (empty($address)) {
            Flash::error('Address not found');

            return redirect(route('address.index'));
        }

        $user = Auth::user();

        $userAddress = UserAddress::where([['user_id','=',$user->id], ['address_id','=',$id]])->first();

        $this->userAddressRepository->delete($userAddress->id);

        $userAddress = UserAddress::where('address_id','=',$id)->get();

        if(count($userAddress)==0){
            $this->addressRepository->delete($id);
        }

        Flash::success('Address deleted successfully.');

        return redirect(route('address.index'));
    }

    public function getCitiesFromZone(Zone $zone){
        return $zone->cities()->pluck('description', 'id');
    }

    public function getLocationsFromCity(City $city){
        return $city->locations()->pluck('description', 'id');
    }

}

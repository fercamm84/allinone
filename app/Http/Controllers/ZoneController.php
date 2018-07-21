<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Repositories\ZoneRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ZoneController extends AppBaseController
{
    /** @var  ZoneRepository */
    private $zoneRepository;

    public function __construct(ZoneRepository $zoneRepo)
    {
        $this->zoneRepository = $zoneRepo;
    }

    /**
     * Display a listing of the Zone.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->zoneRepository->pushCriteria(new RequestCriteria($request));
        $zones = $this->zoneRepository->all();

        return view('zones.index')
            ->with('zones', $zones);
    }

    /**
     * Show the form for creating a new Zone.
     *
     * @return Response
     */
    public function create()
    {
        return view('zones.create');
    }

    /**
     * Store a newly created Zone in storage.
     *
     * @param CreateZoneRequest $request
     *
     * @return Response
     */
    public function store(CreateZoneRequest $request)
    {
        $input = $request->all();

        $zone = $this->zoneRepository->create($input);

        Flash::success('Zone saved successfully.');

        return redirect(route('zones.index'));
    }

    /**
     * Display the specified Zone.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $zone = $this->zoneRepository->findWithoutFail($id);

        if (empty($zone)) {
            Flash::error('Zone not found');

            return redirect(route('zones.index'));
        }

        return view('zones.show')->with('zone', $zone);
    }

    /**
     * Show the form for editing the specified Zone.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $zone = $this->zoneRepository->findWithoutFail($id);

        if (empty($zone)) {
            Flash::error('Zone not found');

            return redirect(route('zones.index'));
        }

        return view('zones.edit')->with('zone', $zone);
    }

    /**
     * Update the specified Zone in storage.
     *
     * @param  int              $id
     * @param UpdateZoneRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateZoneRequest $request)
    {
        $zone = $this->zoneRepository->findWithoutFail($id);

        if (empty($zone)) {
            Flash::error('Zone not found');

            return redirect(route('zones.index'));
        }

        $zone = $this->zoneRepository->update($request->all(), $id);

        Flash::success('Zone updated successfully.');

        return redirect(route('zones.index'));
    }

    /**
     * Remove the specified Zone from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $zone = $this->zoneRepository->findWithoutFail($id);

        if (empty($zone)) {
            Flash::error('Zone not found');

            return redirect(route('zones.index'));
        }

        $this->zoneRepository->delete($id);

        Flash::success('Zone deleted successfully.');

        return redirect(route('zones.index'));
    }
}

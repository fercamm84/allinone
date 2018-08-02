<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSectionEntityRequest;
use App\Http\Requests\UpdateSectionEntityRequest;
use App\Repositories\SectionEntityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SectionEntityController extends AppBaseController
{
    /** @var  SectionEntityRepository */
    private $sectionEntityRepository;

    public function __construct(SectionEntityRepository $sectionEntityRepo)
    {
        $this->sectionEntityRepository = $sectionEntityRepo;
    }

    /**
     * Display a listing of the SectionEntity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sectionEntityRepository->pushCriteria(new RequestCriteria($request));
        $sectionEntities = $this->sectionEntityRepository->all();

        return view('section_entities.index')
            ->with('sectionEntities', $sectionEntities);
    }

    /**
     * Show the form for creating a new SectionEntity.
     *
     * @return Response
     */
    public function create()
    {
        return view('section_entities.create');
    }

    /**
     * Store a newly created SectionEntity in storage.
     *
     * @param CreateSectionEntityRequest $request
     *
     * @return Response
     */
    public function store(CreateSectionEntityRequest $request)
    {
        $input = $request->all();

        $sectionEntity = $this->sectionEntityRepository->create($input);

        Flash::success('Section Entity saved successfully.');

        return redirect(route('sectionEntities.index'));
    }

    /**
     * Display the specified SectionEntity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sectionEntity = $this->sectionEntityRepository->findWithoutFail($id);

        if (empty($sectionEntity)) {
            Flash::error('Section Entity not found');

            return redirect(route('sectionEntities.index'));
        }

        return view('section_entities.show')->with('sectionEntity', $sectionEntity);
    }

    /**
     * Show the form for editing the specified SectionEntity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sectionEntity = $this->sectionEntityRepository->findWithoutFail($id);

        if (empty($sectionEntity)) {
            Flash::error('Section Entity not found');

            return redirect(route('sectionEntities.index'));
        }

        return view('section_entities.edit')->with('sectionEntity', $sectionEntity);
    }

    /**
     * Update the specified SectionEntity in storage.
     *
     * @param  int              $id
     * @param UpdateSectionEntityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSectionEntityRequest $request)
    {
        $sectionEntity = $this->sectionEntityRepository->findWithoutFail($id);

        if (empty($sectionEntity)) {
            Flash::error('Section Entity not found');

            return redirect(route('sectionEntities.index'));
        }

        $sectionEntity = $this->sectionEntityRepository->update($request->all(), $id);

        Flash::success('Section Entity updated successfully.');

        return redirect(route('sectionEntities.index'));
    }

    /**
     * Remove the specified SectionEntity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sectionEntity = $this->sectionEntityRepository->findWithoutFail($id);

        if (empty($sectionEntity)) {
            Flash::error('Section Entity not found');

            return redirect(route('sectionEntities.index'));
        }

        $this->sectionEntityRepository->delete($id);

        Flash::success('Section Entity deleted successfully.');

        return redirect(route('sectionEntities.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttributeEntityRequest;
use App\Http\Requests\UpdateAttributeEntityRequest;
use App\Repositories\AttributeEntityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AttributeEntityController extends AppBaseController
{
    /** @var  AttributeEntityRepository */
    private $attributeEntityRepository;

    public function __construct(AttributeEntityRepository $attributeEntityRepo)
    {
        $this->attributeEntityRepository = $attributeEntityRepo;
    }

    /**
     * Display a listing of the AttributeEntity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->attributeEntityRepository->pushCriteria(new RequestCriteria($request));
        $attributeEntities = $this->attributeEntityRepository->all();

        return view('attribute_entities.index')
            ->with('attributeEntities', $attributeEntities);
    }

    /**
     * Show the form for creating a new AttributeEntity.
     *
     * @return Response
     */
    public function create()
    {
        return view('attribute_entities.create');
    }

    /**
     * Store a newly created AttributeEntity in storage.
     *
     * @param CreateAttributeEntityRequest $request
     *
     * @return Response
     */
    public function store(CreateAttributeEntityRequest $request)
    {
        $input = $request->all();

        $attributeEntity = $this->attributeEntityRepository->create($input);

        Flash::success('Attribute Entity saved successfully.');

        return redirect(route('attributeEntities.index'));
    }

    /**
     * Display the specified AttributeEntity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attributeEntity = $this->attributeEntityRepository->findWithoutFail($id);

        if (empty($attributeEntity)) {
            Flash::error('Attribute Entity not found');

            return redirect(route('attributeEntities.index'));
        }

        return view('attribute_entities.show')->with('attributeEntity', $attributeEntity);
    }

    /**
     * Show the form for editing the specified AttributeEntity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attributeEntity = $this->attributeEntityRepository->findWithoutFail($id);

        if (empty($attributeEntity)) {
            Flash::error('Attribute Entity not found');

            return redirect(route('attributeEntities.index'));
        }

        return view('attribute_entities.edit')->with('attributeEntity', $attributeEntity);
    }

    /**
     * Update the specified AttributeEntity in storage.
     *
     * @param  int              $id
     * @param UpdateAttributeEntityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttributeEntityRequest $request)
    {
        $attributeEntity = $this->attributeEntityRepository->findWithoutFail($id);

        if (empty($attributeEntity)) {
            Flash::error('Attribute Entity not found');

            return redirect(route('attributeEntities.index'));
        }

        $attributeEntity = $this->attributeEntityRepository->update($request->all(), $id);

        Flash::success('Attribute Entity updated successfully.');

        return redirect(route('attributeEntities.index'));
    }

    /**
     * Remove the specified AttributeEntity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attributeEntity = $this->attributeEntityRepository->findWithoutFail($id);

        if (empty($attributeEntity)) {
            Flash::error('Attribute Entity not found');

            return redirect(route('attributeEntities.index'));
        }

        $this->attributeEntityRepository->delete($id);

        Flash::success('Attribute Entity deleted successfully.');

        return redirect(route('attributeEntities.index'));
    }
}

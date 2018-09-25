<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttributeValueEntityRequest;
use App\Http\Requests\UpdateAttributeValueEntityRequest;
use App\Repositories\AttributeValueEntityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AttributeValueEntityController extends AppBaseController
{
    /** @var  AttributeValueEntityRepository */
    private $attributeValueEntityRepository;

    public function __construct(AttributeValueEntityRepository $attributeValueEntityRepo)
    {
        $this->attributeValueEntityRepository = $attributeValueEntityRepo;
    }

    /**
     * Display a listing of the AttributeValueEntity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->attributeValueEntityRepository->pushCriteria(new RequestCriteria($request));
        $attributeValueEntities = $this->attributeValueEntityRepository->all();

        return view('attribute_value_entities.index')
            ->with('attributeValueEntities', $attributeValueEntities);
    }

    /**
     * Show the form for creating a new AttributeValueEntity.
     *
     * @return Response
     */
    public function create()
    {
        return view('attribute_value_entities.create');
    }

    /**
     * Store a newly created AttributeValueEntity in storage.
     *
     * @param CreateAttributeValueEntityRequest $request
     *
     * @return Response
     */
    public function store(CreateAttributeValueEntityRequest $request)
    {
        $input = $request->all();

        $attributeValueEntity = $this->attributeValueEntityRepository->create($input);

        Flash::success('Attribute Value Entity saved successfully.');

        return redirect(route('attributeValueEntities.index'));
    }

    /**
     * Display the specified AttributeValueEntity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attributeValueEntity = $this->attributeValueEntityRepository->findWithoutFail($id);

        if (empty($attributeValueEntity)) {
            Flash::error('Attribute Value Entity not found');

            return redirect(route('attributeValueEntities.index'));
        }

        return view('attribute_value_entities.show')->with('attributeValueEntity', $attributeValueEntity);
    }

    /**
     * Show the form for editing the specified AttributeValueEntity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attributeValueEntity = $this->attributeValueEntityRepository->findWithoutFail($id);

        if (empty($attributeValueEntity)) {
            Flash::error('Attribute Value Entity not found');

            return redirect(route('attributeValueEntities.index'));
        }

        return view('attribute_value_entities.edit')->with('attributeValueEntity', $attributeValueEntity);
    }

    /**
     * Update the specified AttributeValueEntity in storage.
     *
     * @param  int              $id
     * @param UpdateAttributeValueEntityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttributeValueEntityRequest $request)
    {
        $attributeValueEntity = $this->attributeValueEntityRepository->findWithoutFail($id);

        if (empty($attributeValueEntity)) {
            Flash::error('Attribute Value Entity not found');

            return redirect(route('attributeValueEntities.index'));
        }

        $attributeValueEntity = $this->attributeValueEntityRepository->update($request->all(), $id);

        Flash::success('Attribute Value Entity updated successfully.');

        return redirect(route('attributeValueEntities.index'));
    }

    /**
     * Remove the specified AttributeValueEntity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attributeValueEntity = $this->attributeValueEntityRepository->findWithoutFail($id);

        if (empty($attributeValueEntity)) {
            Flash::error('Attribute Value Entity not found');

            return redirect(route('attributeValueEntities.index'));
        }

        $this->attributeValueEntityRepository->delete($id);

        Flash::success('Attribute Value Entity deleted successfully.');

        return redirect(route('attributeValueEntities.index'));
    }
}

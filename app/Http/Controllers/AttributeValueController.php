<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttributeValueRequest;
use App\Http\Requests\UpdateAttributeValueRequest;
use App\Repositories\AttributeValueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AttributeValueController extends AppBaseController
{
    /** @var  AttributeValueRepository */
    private $attributeValueRepository;

    public function __construct(AttributeValueRepository $attributeValueRepo)
    {
        $this->attributeValueRepository = $attributeValueRepo;
    }

    /**
     * Display a listing of the AttributeValue.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->attributeValueRepository->pushCriteria(new RequestCriteria($request));
        $attributeValues = $this->attributeValueRepository->all();

        return view('attribute_values.index')
            ->with('attributeValues', $attributeValues);
    }

    /**
     * Show the form for creating a new AttributeValue.
     *
     * @return Response
     */
    public function create()
    {
        return view('attribute_values.create');
    }

    /**
     * Store a newly created AttributeValue in storage.
     *
     * @param CreateAttributeValueRequest $request
     *
     * @return Response
     */
    public function store(CreateAttributeValueRequest $request)
    {
        $input = $request->all();

        $attributeValue = $this->attributeValueRepository->create($input);

        Flash::success('Attribute Value saved successfully.');

        return redirect(route('attributeValues.index'));
    }

    /**
     * Display the specified AttributeValue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attributeValue = $this->attributeValueRepository->findWithoutFail($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }

        return view('attribute_values.show')->with('attributeValue', $attributeValue);
    }

    /**
     * Show the form for editing the specified AttributeValue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attributeValue = $this->attributeValueRepository->findWithoutFail($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }

        return view('attribute_values.edit')->with('attributeValue', $attributeValue);
    }

    /**
     * Update the specified AttributeValue in storage.
     *
     * @param  int              $id
     * @param UpdateAttributeValueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttributeValueRequest $request)
    {
        $attributeValue = $this->attributeValueRepository->findWithoutFail($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }

        $attributeValue = $this->attributeValueRepository->update($request->all(), $id);

        Flash::success('Attribute Value updated successfully.');

        return redirect(route('attributeValues.index'));
    }

    /**
     * Remove the specified AttributeValue from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attributeValue = $this->attributeValueRepository->findWithoutFail($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }

        $this->attributeValueRepository->delete($id);

        Flash::success('Attribute Value deleted successfully.');

        return redirect(route('attributeValues.index'));
    }
}

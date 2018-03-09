<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryAttributeRequest;
use App\Http\Requests\UpdateCategoryAttributeRequest;
use App\Repositories\CategoryAttributeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CategoryAttributeController extends AppBaseController
{
    /** @var  CategoryAttributeRepository */
    private $categoryAttributeRepository;

    public function __construct(CategoryAttributeRepository $categoryAttributeRepo)
    {
        $this->categoryAttributeRepository = $categoryAttributeRepo;
    }

    /**
     * Display a listing of the CategoryAttribute.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categoryAttributeRepository->pushCriteria(new RequestCriteria($request));
        $categoryAttributes = $this->categoryAttributeRepository->all();

        return view('category_attributes.index')
            ->with('categoryAttributes', $categoryAttributes);
    }

    /**
     * Show the form for creating a new CategoryAttribute.
     *
     * @return Response
     */
    public function create()
    {
        return view('category_attributes.create');
    }

    /**
     * Store a newly created CategoryAttribute in storage.
     *
     * @param CreateCategoryAttributeRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryAttributeRequest $request)
    {
        $input = $request->all();

        $categoryAttribute = $this->categoryAttributeRepository->create($input);

        Flash::success('Category Attribute saved successfully.');

        return redirect(route('categoryAttributes.index'));
    }

    /**
     * Display the specified CategoryAttribute.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoryAttribute = $this->categoryAttributeRepository->findWithoutFail($id);

        if (empty($categoryAttribute)) {
            Flash::error('Category Attribute not found');

            return redirect(route('categoryAttributes.index'));
        }

        return view('category_attributes.show')->with('categoryAttribute', $categoryAttribute);
    }

    /**
     * Show the form for editing the specified CategoryAttribute.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categoryAttribute = $this->categoryAttributeRepository->findWithoutFail($id);

        if (empty($categoryAttribute)) {
            Flash::error('Category Attribute not found');

            return redirect(route('categoryAttributes.index'));
        }

        return view('category_attributes.edit')->with('categoryAttribute', $categoryAttribute);
    }

    /**
     * Update the specified CategoryAttribute in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryAttributeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryAttributeRequest $request)
    {
        $categoryAttribute = $this->categoryAttributeRepository->findWithoutFail($id);

        if (empty($categoryAttribute)) {
            Flash::error('Category Attribute not found');

            return redirect(route('categoryAttributes.index'));
        }

        $categoryAttribute = $this->categoryAttributeRepository->update($request->all(), $id);

        Flash::success('Category Attribute updated successfully.');

        return redirect(route('categoryAttributes.index'));
    }

    /**
     * Remove the specified CategoryAttribute from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categoryAttribute = $this->categoryAttributeRepository->findWithoutFail($id);

        if (empty($categoryAttribute)) {
            Flash::error('Category Attribute not found');

            return redirect(route('categoryAttributes.index'));
        }

        $this->categoryAttributeRepository->delete($id);

        Flash::success('Category Attribute deleted successfully.');

        return redirect(route('categoryAttributes.index'));
    }
}

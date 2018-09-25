<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBrandCategoryRequest;
use App\Http\Requests\UpdateBrandCategoryRequest;
use App\Repositories\BrandCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BrandCategoryController extends AppBaseController
{
    /** @var  BrandCategoryRepository */
    private $brandCategoryRepository;

    public function __construct(BrandCategoryRepository $brandCategoryRepo)
    {
        $this->brandCategoryRepository = $brandCategoryRepo;
    }

    /**
     * Display a listing of the BrandCategory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->brandCategoryRepository->pushCriteria(new RequestCriteria($request));
        $brandCategories = $this->brandCategoryRepository->all();

        return view('brand_categories.index')
            ->with('brandCategories', $brandCategories);
    }

    /**
     * Show the form for creating a new BrandCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('brand_categories.create');
    }

    /**
     * Store a newly created BrandCategory in storage.
     *
     * @param CreateBrandCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandCategoryRequest $request)
    {
        $input = $request->all();

        $brandCategory = $this->brandCategoryRepository->create($input);

        Flash::success('Brand Category saved successfully.');

        return redirect(route('brandCategories.index'));
    }

    /**
     * Display the specified BrandCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $brandCategory = $this->brandCategoryRepository->findWithoutFail($id);

        if (empty($brandCategory)) {
            Flash::error('Brand Category not found');

            return redirect(route('brandCategories.index'));
        }

        return view('brand_categories.show')->with('brandCategory', $brandCategory);
    }

    /**
     * Show the form for editing the specified BrandCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $brandCategory = $this->brandCategoryRepository->findWithoutFail($id);

        if (empty($brandCategory)) {
            Flash::error('Brand Category not found');

            return redirect(route('brandCategories.index'));
        }

        return view('brand_categories.edit')->with('brandCategory', $brandCategory);
    }

    /**
     * Update the specified BrandCategory in storage.
     *
     * @param  int              $id
     * @param UpdateBrandCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandCategoryRequest $request)
    {
        $brandCategory = $this->brandCategoryRepository->findWithoutFail($id);

        if (empty($brandCategory)) {
            Flash::error('Brand Category not found');

            return redirect(route('brandCategories.index'));
        }

        $brandCategory = $this->brandCategoryRepository->update($request->all(), $id);

        Flash::success('Brand Category updated successfully.');

        return redirect(route('brandCategories.index'));
    }

    /**
     * Remove the specified BrandCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $brandCategory = $this->brandCategoryRepository->findWithoutFail($id);

        if (empty($brandCategory)) {
            Flash::error('Brand Category not found');

            return redirect(route('brandCategories.index'));
        }

        $this->brandCategoryRepository->delete($id);

        Flash::success('Brand Category deleted successfully.');

        return redirect(route('brandCategories.index'));
    }
}

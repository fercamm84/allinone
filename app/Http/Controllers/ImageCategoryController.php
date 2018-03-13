<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImageCategoryRequest;
use App\Http\Requests\UpdateImageCategoryRequest;
use App\Repositories\ImageCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ImageCategoryController extends AppBaseController
{
    /** @var  ImageCategoryRepository */
    private $imageCategoryRepository;

    public function __construct(ImageCategoryRepository $imageCategoryRepo)
    {
        $this->imageCategoryRepository = $imageCategoryRepo;
    }

    /**
     * Display a listing of the ImageCategory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->imageCategoryRepository->pushCriteria(new RequestCriteria($request));
        $imageCategories = $this->imageCategoryRepository->all();

        return view('image_categories.index')
            ->with('imageCategories', $imageCategories);
    }

    /**
     * Show the form for creating a new ImageCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('image_categories.create');
    }

    /**
     * Store a newly created ImageCategory in storage.
     *
     * @param CreateImageCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateImageCategoryRequest $request)
    {
        $input = $request->all();

        $imageCategory = $this->imageCategoryRepository->create($input);

        Flash::success('Image Category saved successfully.');

        return redirect(route('imageCategories.index'));
    }

    /**
     * Display the specified ImageCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $imageCategory = $this->imageCategoryRepository->findWithoutFail($id);

        if (empty($imageCategory)) {
            Flash::error('Image Category not found');

            return redirect(route('imageCategories.index'));
        }

        return view('image_categories.show')->with('imageCategory', $imageCategory);
    }

    /**
     * Show the form for editing the specified ImageCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $imageCategory = $this->imageCategoryRepository->findWithoutFail($id);

        if (empty($imageCategory)) {
            Flash::error('Image Category not found');

            return redirect(route('imageCategories.index'));
        }

        return view('image_categories.edit')->with('imageCategory', $imageCategory);
    }

    /**
     * Update the specified ImageCategory in storage.
     *
     * @param  int              $id
     * @param UpdateImageCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateImageCategoryRequest $request)
    {
        $imageCategory = $this->imageCategoryRepository->findWithoutFail($id);

        if (empty($imageCategory)) {
            Flash::error('Image Category not found');

            return redirect(route('imageCategories.index'));
        }

        $imageCategory = $this->imageCategoryRepository->update($request->all(), $id);

        Flash::success('Image Category updated successfully.');

        return redirect(route('imageCategories.index'));
    }

    /**
     * Remove the specified ImageCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $imageCategory = $this->imageCategoryRepository->findWithoutFail($id);

        if (empty($imageCategory)) {
            Flash::error('Image Category not found');

            return redirect(route('imageCategories.index'));
        }

        $this->imageCategoryRepository->delete($id);

        Flash::success('Image Category deleted successfully.');

        return redirect(route('imageCategories.index'));
    }
}

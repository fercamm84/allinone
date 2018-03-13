<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSectionCategoryRequest;
use App\Http\Requests\UpdateSectionCategoryRequest;
use App\Repositories\SectionCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SectionCategoryController extends AppBaseController
{
    /** @var  SectionCategoryRepository */
    private $sectionCategoryRepository;

    public function __construct(SectionCategoryRepository $sectionCategoryRepo)
    {
        $this->sectionCategoryRepository = $sectionCategoryRepo;
    }

    /**
     * Display a listing of the SectionCategory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sectionCategoryRepository->pushCriteria(new RequestCriteria($request));
        $sectionCategories = $this->sectionCategoryRepository->all();

        return view('section_categories.index')
            ->with('sectionCategories', $sectionCategories);
    }

    /**
     * Show the form for creating a new SectionCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('section_categories.create');
    }

    /**
     * Store a newly created SectionCategory in storage.
     *
     * @param CreateSectionCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateSectionCategoryRequest $request)
    {
        $input = $request->all();

        $sectionCategory = $this->sectionCategoryRepository->create($input);

        Flash::success('Section Category saved successfully.');

        return redirect(route('sectionCategories.index'));
    }

    /**
     * Display the specified SectionCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sectionCategory = $this->sectionCategoryRepository->findWithoutFail($id);

        if (empty($sectionCategory)) {
            Flash::error('Section Category not found');

            return redirect(route('sectionCategories.index'));
        }

        return view('section_categories.show')->with('sectionCategory', $sectionCategory);
    }

    /**
     * Show the form for editing the specified SectionCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sectionCategory = $this->sectionCategoryRepository->findWithoutFail($id);

        if (empty($sectionCategory)) {
            Flash::error('Section Category not found');

            return redirect(route('sectionCategories.index'));
        }

        return view('section_categories.edit')->with('sectionCategory', $sectionCategory);
    }

    /**
     * Update the specified SectionCategory in storage.
     *
     * @param  int              $id
     * @param UpdateSectionCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSectionCategoryRequest $request)
    {
        $sectionCategory = $this->sectionCategoryRepository->findWithoutFail($id);

        if (empty($sectionCategory)) {
            Flash::error('Section Category not found');

            return redirect(route('sectionCategories.index'));
        }

        $sectionCategory = $this->sectionCategoryRepository->update($request->all(), $id);

        Flash::success('Section Category updated successfully.');

        return redirect(route('sectionCategories.index'));
    }

    /**
     * Remove the specified SectionCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sectionCategory = $this->sectionCategoryRepository->findWithoutFail($id);

        if (empty($sectionCategory)) {
            Flash::error('Section Category not found');

            return redirect(route('sectionCategories.index'));
        }

        $this->sectionCategoryRepository->delete($id);

        Flash::success('Section Category deleted successfully.');

        return redirect(route('sectionCategories.index'));
    }
}

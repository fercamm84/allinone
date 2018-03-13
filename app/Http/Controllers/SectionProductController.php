<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSectionProductRequest;
use App\Http\Requests\UpdateSectionProductRequest;
use App\Repositories\SectionProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SectionProductController extends AppBaseController
{
    /** @var  SectionProductRepository */
    private $sectionProductRepository;

    public function __construct(SectionProductRepository $sectionProductRepo)
    {
        $this->sectionProductRepository = $sectionProductRepo;
    }

    /**
     * Display a listing of the SectionProduct.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sectionProductRepository->pushCriteria(new RequestCriteria($request));
        $sectionProducts = $this->sectionProductRepository->all();

        return view('section_products.index')
            ->with('sectionProducts', $sectionProducts);
    }

    /**
     * Show the form for creating a new SectionProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('section_products.create');
    }

    /**
     * Store a newly created SectionProduct in storage.
     *
     * @param CreateSectionProductRequest $request
     *
     * @return Response
     */
    public function store(CreateSectionProductRequest $request)
    {
        $input = $request->all();

        $sectionProduct = $this->sectionProductRepository->create($input);

        Flash::success('Section Product saved successfully.');

        return redirect(route('sectionProducts.index'));
    }

    /**
     * Display the specified SectionProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sectionProduct = $this->sectionProductRepository->findWithoutFail($id);

        if (empty($sectionProduct)) {
            Flash::error('Section Product not found');

            return redirect(route('sectionProducts.index'));
        }

        return view('section_products.show')->with('sectionProduct', $sectionProduct);
    }

    /**
     * Show the form for editing the specified SectionProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sectionProduct = $this->sectionProductRepository->findWithoutFail($id);

        if (empty($sectionProduct)) {
            Flash::error('Section Product not found');

            return redirect(route('sectionProducts.index'));
        }

        return view('section_products.edit')->with('sectionProduct', $sectionProduct);
    }

    /**
     * Update the specified SectionProduct in storage.
     *
     * @param  int              $id
     * @param UpdateSectionProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSectionProductRequest $request)
    {
        $sectionProduct = $this->sectionProductRepository->findWithoutFail($id);

        if (empty($sectionProduct)) {
            Flash::error('Section Product not found');

            return redirect(route('sectionProducts.index'));
        }

        $sectionProduct = $this->sectionProductRepository->update($request->all(), $id);

        Flash::success('Section Product updated successfully.');

        return redirect(route('sectionProducts.index'));
    }

    /**
     * Remove the specified SectionProduct from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sectionProduct = $this->sectionProductRepository->findWithoutFail($id);

        if (empty($sectionProduct)) {
            Flash::error('Section Product not found');

            return redirect(route('sectionProducts.index'));
        }

        $this->sectionProductRepository->delete($id);

        Flash::success('Section Product deleted successfully.');

        return redirect(route('sectionProducts.index'));
    }
}

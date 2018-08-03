<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSellerCategoryRequest;
use App\Http\Requests\UpdateSellerCategoryRequest;
use App\Repositories\SellerCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SellerCategoryController extends AppBaseController
{
    /** @var  SellerCategoryRepository */
    private $sellerCategoryRepository;

    public function __construct(SellerCategoryRepository $sellerCategoryRepo)
    {
        $this->sellerCategoryRepository = $sellerCategoryRepo;
    }

    /**
     * Display a listing of the SellerCategory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sellerCategoryRepository->pushCriteria(new RequestCriteria($request));
        $sellerCategories = $this->sellerCategoryRepository->all();

        return view('seller_categories.index')
            ->with('sellerCategories', $sellerCategories);
    }

    /**
     * Show the form for creating a new SellerCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('seller_categories.create');
    }

    /**
     * Store a newly created SellerCategory in storage.
     *
     * @param CreateSellerCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateSellerCategoryRequest $request)
    {
        $input = $request->all();

        $sellerCategory = $this->sellerCategoryRepository->create($input);

        Flash::success('Seller Category saved successfully.');

        return redirect(route('sellerCategories.index'));
    }

    /**
     * Display the specified SellerCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sellerCategory = $this->sellerCategoryRepository->findWithoutFail($id);

        if (empty($sellerCategory)) {
            Flash::error('Seller Category not found');

            return redirect(route('sellerCategories.index'));
        }

        return view('seller_categories.show')->with('sellerCategory', $sellerCategory);
    }

    /**
     * Show the form for editing the specified SellerCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sellerCategory = $this->sellerCategoryRepository->findWithoutFail($id);

        if (empty($sellerCategory)) {
            Flash::error('Seller Category not found');

            return redirect(route('sellerCategories.index'));
        }

        return view('seller_categories.edit')->with('sellerCategory', $sellerCategory);
    }

    /**
     * Update the specified SellerCategory in storage.
     *
     * @param  int              $id
     * @param UpdateSellerCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSellerCategoryRequest $request)
    {
        $sellerCategory = $this->sellerCategoryRepository->findWithoutFail($id);

        if (empty($sellerCategory)) {
            Flash::error('Seller Category not found');

            return redirect(route('sellerCategories.index'));
        }

        $sellerCategory = $this->sellerCategoryRepository->update($request->all(), $id);

        Flash::success('Seller Category updated successfully.');

        return redirect(route('sellerCategories.index'));
    }

    /**
     * Remove the specified SellerCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sellerCategory = $this->sellerCategoryRepository->findWithoutFail($id);

        if (empty($sellerCategory)) {
            Flash::error('Seller Category not found');

            return redirect(route('sellerCategories.index'));
        }

        $this->sellerCategoryRepository->delete($id);

        Flash::success('Seller Category deleted successfully.');

        return redirect(route('sellerCategories.index'));
    }
}

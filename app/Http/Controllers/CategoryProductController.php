<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryProductRequest;
use App\Http\Requests\UpdateCategoryProductRequest;
use App\Repositories\CategoryProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CategoryProductController extends AppBaseController
{
    /** @var  CategoryProductRepository */
    private $categoryProductRepository;

    public function __construct(CategoryProductRepository $categoryProductRepo)
    {
        $this->categoryProductRepository = $categoryProductRepo;
    }

    /**
     * Display a listing of the CategoryProduct.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categoryProductRepository->pushCriteria(new RequestCriteria($request));
        $categoryProducts = $this->categoryProductRepository->all();

        return view('category_products.index')
            ->with('categoryProducts', $categoryProducts);
    }

    /**
     * Show the form for creating a new CategoryProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('category_products.create');
    }

    /**
     * Store a newly created CategoryProduct in storage.
     *
     * @param CreateCategoryProductRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryProductRequest $request)
    {
        $input = $request->all();

        $categoryProduct = $this->categoryProductRepository->create($input);

        Flash::success('Category Product saved successfully.');

        return redirect(route('categoryProducts.index'));
    }

    /**
     * Display the specified CategoryProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoryProduct = $this->categoryProductRepository->findWithoutFail($id);

        if (empty($categoryProduct)) {
            Flash::error('Category Product not found');

            return redirect(route('categoryProducts.index'));
        }

        return view('category_products.show')->with('categoryProduct', $categoryProduct);
    }

    /**
     * Show the form for editing the specified CategoryProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categoryProduct = $this->categoryProductRepository->findWithoutFail($id);

        if (empty($categoryProduct)) {
            Flash::error('Category Product not found');

            return redirect(route('categoryProducts.index'));
        }

        return view('category_products.edit')->with('categoryProduct', $categoryProduct);
    }

    /**
     * Update the specified CategoryProduct in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryProductRequest $request)
    {
        $categoryProduct = $this->categoryProductRepository->findWithoutFail($id);

        if (empty($categoryProduct)) {
            Flash::error('Category Product not found');

            return redirect(route('categoryProducts.index'));
        }

        $categoryProduct = $this->categoryProductRepository->update($request->all(), $id);

        Flash::success('Category Product updated successfully.');

        return redirect(route('categoryProducts.index'));
    }

    /**
     * Remove the specified CategoryProduct from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categoryProduct = $this->categoryProductRepository->findWithoutFail($id);

        if (empty($categoryProduct)) {
            Flash::error('Category Product not found');

            return redirect(route('categoryProducts.index'));
        }

        $this->categoryProductRepository->delete($id);

        Flash::success('Category Product deleted successfully.');

        return redirect(route('categoryProducts.index'));
    }
}

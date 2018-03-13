<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImageProductRequest;
use App\Http\Requests\UpdateImageProductRequest;
use App\Repositories\ImageProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ImageProductController extends AppBaseController
{
    /** @var  ImageProductRepository */
    private $imageProductRepository;

    public function __construct(ImageProductRepository $imageProductRepo)
    {
        $this->imageProductRepository = $imageProductRepo;
    }

    /**
     * Display a listing of the ImageProduct.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->imageProductRepository->pushCriteria(new RequestCriteria($request));
        $imageProducts = $this->imageProductRepository->all();

        return view('image_products.index')
            ->with('imageProducts', $imageProducts);
    }

    /**
     * Show the form for creating a new ImageProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('image_products.create');
    }

    /**
     * Store a newly created ImageProduct in storage.
     *
     * @param CreateImageProductRequest $request
     *
     * @return Response
     */
    public function store(CreateImageProductRequest $request)
    {
        $input = $request->all();

        $imageProduct = $this->imageProductRepository->create($input);

        Flash::success('Image Product saved successfully.');

        return redirect(route('imageProducts.index'));
    }

    /**
     * Display the specified ImageProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $imageProduct = $this->imageProductRepository->findWithoutFail($id);

        if (empty($imageProduct)) {
            Flash::error('Image Product not found');

            return redirect(route('imageProducts.index'));
        }

        return view('image_products.show')->with('imageProduct', $imageProduct);
    }

    /**
     * Show the form for editing the specified ImageProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $imageProduct = $this->imageProductRepository->findWithoutFail($id);

        if (empty($imageProduct)) {
            Flash::error('Image Product not found');

            return redirect(route('imageProducts.index'));
        }

        return view('image_products.edit')->with('imageProduct', $imageProduct);
    }

    /**
     * Update the specified ImageProduct in storage.
     *
     * @param  int              $id
     * @param UpdateImageProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateImageProductRequest $request)
    {
        $imageProduct = $this->imageProductRepository->findWithoutFail($id);

        if (empty($imageProduct)) {
            Flash::error('Image Product not found');

            return redirect(route('imageProducts.index'));
        }

        $imageProduct = $this->imageProductRepository->update($request->all(), $id);

        Flash::success('Image Product updated successfully.');

        return redirect(route('imageProducts.index'));
    }

    /**
     * Remove the specified ImageProduct from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $imageProduct = $this->imageProductRepository->findWithoutFail($id);

        if (empty($imageProduct)) {
            Flash::error('Image Product not found');

            return redirect(route('imageProducts.index'));
        }

        $this->imageProductRepository->delete($id);

        Flash::success('Image Product deleted successfully.');

        return redirect(route('imageProducts.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImageEntityRequest;
use App\Http\Requests\UpdateImageEntityRequest;
use App\Repositories\ImageEntityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ImageEntityController extends AppBaseController
{
    /** @var  ImageEntityRepository */
    private $imageEntityRepository;

    public function __construct(ImageEntityRepository $imageEntityRepo)
    {
        $this->imageEntityRepository = $imageEntityRepo;
    }

    /**
     * Display a listing of the ImageEntity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->imageEntityRepository->pushCriteria(new RequestCriteria($request));
        $imageEntities = $this->imageEntityRepository->all();

        return view('image_entities.index')
            ->with('imageEntities', $imageEntities);
    }

    /**
     * Show the form for creating a new ImageEntity.
     *
     * @return Response
     */
    public function create()
    {
        return view('image_entities.create');
    }

    /**
     * Store a newly created ImageEntity in storage.
     *
     * @param CreateImageEntityRequest $request
     *
     * @return Response
     */
    public function store(CreateImageEntityRequest $request)
    {
        $input = $request->all();

        $imageEntity = $this->imageEntityRepository->create($input);

        Flash::success('Image Entity saved successfully.');

        return redirect(route('imageEntities.index'));
    }

    /**
     * Display the specified ImageEntity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $imageEntity = $this->imageEntityRepository->findWithoutFail($id);

        if (empty($imageEntity)) {
            Flash::error('Image Entity not found');

            return redirect(route('imageEntities.index'));
        }

        return view('image_entities.show')->with('imageEntity', $imageEntity);
    }

    /**
     * Show the form for editing the specified ImageEntity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $imageEntity = $this->imageEntityRepository->findWithoutFail($id);

        if (empty($imageEntity)) {
            Flash::error('Image Entity not found');

            return redirect(route('imageEntities.index'));
        }

        return view('image_entities.edit')->with('imageEntity', $imageEntity);
    }

    /**
     * Update the specified ImageEntity in storage.
     *
     * @param  int              $id
     * @param UpdateImageEntityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateImageEntityRequest $request)
    {
        $imageEntity = $this->imageEntityRepository->findWithoutFail($id);

        if (empty($imageEntity)) {
            Flash::error('Image Entity not found');

            return redirect(route('imageEntities.index'));
        }

        $imageEntity = $this->imageEntityRepository->update($request->all(), $id);

        Flash::success('Image Entity updated successfully.');

        return redirect(route('imageEntities.index'));
    }

    /**
     * Remove the specified ImageEntity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $imageEntity = $this->imageEntityRepository->findWithoutFail($id);

        if (empty($imageEntity)) {
            Flash::error('Image Entity not found');

            return redirect(route('imageEntities.index'));
        }

        $this->imageEntityRepository->delete($id);

        Flash::success('Image Entity deleted successfully.');

        return redirect(route('imageEntities.index'));
    }
}

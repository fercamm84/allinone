<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMailingRequest;
use App\Http\Requests\UpdateMailingRequest;
use App\Repositories\MailingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MailingController extends AppBaseController
{
    /** @var  MailingRepository */
    private $mailingRepository;

    public function __construct(MailingRepository $mailingRepo)
    {
        $this->mailingRepository = $mailingRepo;
    }

    /**
     * Display a listing of the Mailing.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->mailingRepository->pushCriteria(new RequestCriteria($request));
        $mailings = $this->mailingRepository->all();

        return view('mailings.index')
            ->with('mailings', $mailings);
    }

    /**
     * Show the form for creating a new Mailing.
     *
     * @return Response
     */
    public function create()
    {
        return view('mailings.create');
    }

    /**
     * Store a newly created Mailing in storage.
     *
     * @param CreateMailingRequest $request
     *
     * @return Response
     */
    public function store(CreateMailingRequest $request)
    {
        $input = $request->all();

        $mailing = $this->mailingRepository->create($input);

        Flash::success('Mailing saved successfully.');

        return redirect(route('mailings.index'));
    }

    /**
     * Display the specified Mailing.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mailing = $this->mailingRepository->findWithoutFail($id);

        if (empty($mailing)) {
            Flash::error('Mailing not found');

            return redirect(route('mailings.index'));
        }

        return view('mailings.show')->with('mailing', $mailing);
    }

    /**
     * Show the form for editing the specified Mailing.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mailing = $this->mailingRepository->findWithoutFail($id);

        if (empty($mailing)) {
            Flash::error('Mailing not found');

            return redirect(route('mailings.index'));
        }

        return view('mailings.edit')->with('mailing', $mailing);
    }

    /**
     * Update the specified Mailing in storage.
     *
     * @param  int              $id
     * @param UpdateMailingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMailingRequest $request)
    {
        $mailing = $this->mailingRepository->findWithoutFail($id);

        if (empty($mailing)) {
            Flash::error('Mailing not found');

            return redirect(route('mailings.index'));
        }

        $mailing = $this->mailingRepository->update($request->all(), $id);

        Flash::success('Mailing updated successfully.');

        return redirect(route('mailings.index'));
    }

    /**
     * Remove the specified Mailing from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mailing = $this->mailingRepository->findWithoutFail($id);

        if (empty($mailing)) {
            Flash::error('Mailing not found');

            return redirect(route('mailings.index'));
        }

        $this->mailingRepository->delete($id);

        Flash::success('Mailing deleted successfully.');

        return redirect(route('mailings.index'));
    }
}

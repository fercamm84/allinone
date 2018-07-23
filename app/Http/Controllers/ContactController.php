<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMailingRequest;
use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\MailingRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use SantiGraviano\LaravelMercadoPago\Facades\MP;

class ContactController extends AppBaseController
{
    /** @var  MailingRepository */
    private $mailingRepository;

    public function __construct(MailingRepository $mailingRepo)
    {
        $this->mailingRepository = $mailingRepo;
    }

    /**
     * Display a Form Contact.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        return view('contact.index');
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

        Flash::success('Contact saved successfully.');

        return redirect(route('contact.index'));
    }

}

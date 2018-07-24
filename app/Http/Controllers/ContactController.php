<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMailingRequest;
use App\Http\Helpers\SendMailHelper;
use App\Repositories\MailingRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class ContactController extends AppBaseController
{
    /** @var  MailingRepository */
    private $mailingRepository;

    private $SendMailHelper;

    public function __construct(MailingRepository $mailingRepo)
    {
        $this->mailingRepository = $mailingRepo;
        $this->SendMailHelper = new SendMailHelper();
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

        $this->SendMailHelper->sendEmailContactUs($mailing);

        Flash::success('Contact saved successfully.');

        return redirect(route('contact.index'));
    }

}

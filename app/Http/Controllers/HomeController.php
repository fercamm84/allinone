<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Repositories\ParameterRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $parameterRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ParameterRepository $parameterRepo)
    {
        $this->middleware('auth');

        $this->parameterRepository = $parameterRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parameter = Parameter::where('field','=','CANTIDAD_REGISTROS_HISTORICO')->first()->value;

        $parameter = $this->parameterRepository->all();

        return view('home');
    }
}

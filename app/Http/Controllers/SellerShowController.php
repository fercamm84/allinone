<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\SellerDay;
use App\Models\SellerReservation;
use App\Repositories\SellerDayRepository;
use App\Repositories\SellerReservationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerShowController extends Controller
{

    /** @var  SellerDayRepository */
    private $sellerDayRepository;

    /** @var  SellerReservationRepository */
    private $sellerReservationRepository;

    public function __construct(SellerDayRepository $sellerDayRepo, SellerReservationRepository $sellerReservationRepo){
        $this->sellerDayRepository = $sellerDayRepo;
        $this->sellerReservationRepository = $sellerReservationRepo;
    }

    public function index($id = null){
        $seller = Seller::find($id);

        $entity_parents = array();
        array_push($entity_parents, $seller);

        $entity_children = array();

        foreach ($seller->sellerCategories as $sellerCategory) {
            array_push($entity_children, $sellerCategory->category);
        }

        $sellerDay = SellerDay::where([['seller_id', '=', $id], ['date', '=', DB::raw('CURDATE()')]])->first();

        return view('seller.seller', array('entity_parents' => $entity_parents, 'entity_children' => $entity_children,
            'categories' => $entity_children, 'seller' => $seller, 'sellerDay' => $sellerDay));
    }

    public function reservation(Request $request){
        $seller = Seller::find($request->input('seller_id'));
        $number_of_reservations = $request->input('number_of_reservations');

        list($sellerDay, $hours) = $this->calculateAvailability($seller);

        return view('seller.reservation', array('seller' => $seller, 'sellerDay' => $sellerDay, 'hours' => $hours, 'number_of_reservations' => $number_of_reservations));
    }

    public function reserve(Request $request){
        $sellerDay = SellerDay::find($request->input('seller_day_id'));
        $number_of_reservations = $request->input('number_of_reservations');
        $from_hour = intval($request->input('from_hour'));
        $to_hour = intval($request->input('hours')) + $from_hour;

        $user = Auth::user();

        $sellerReservation = array();
        $sellerReservation['seller_day_id'] = $sellerDay->id;
        $sellerReservation['user_id'] = $user->id;
        $sellerReservation['total'] = $number_of_reservations;
        $sellerReservation['from_hour'] = $from_hour;
        $sellerReservation['to_hour'] = $to_hour;

        $this->sellerReservationRepository->create($sellerReservation);

        $seller = $sellerDay->seller;

        $entity_parents = array();
        array_push($entity_parents, $seller);

        $entity_children = array();

        foreach ($seller->sellerCategories as $sellerCategory) {
            array_push($entity_children, $sellerCategory->category);
        }

        Flash::success('Reserva realizada.');

        return view('seller.seller', array('entity_parents' => $entity_parents, 'entity_children' => $entity_children,
            'categories' => $entity_children, 'seller' => $seller, 'sellerDay' => $sellerDay));
    }

    /**
     * Se crea un vector de horas (key del vector) con su disponibilidad (value)
     *
     * @param $seller
     * @return array
     */
    private function calculateAvailability($seller){
        $sellerDay = SellerDay::where([['seller_id', '=', $seller->id], ['date', '=', DB::raw('CURDATE()')]])->first();

        $hours = array();

        if($sellerDay){
            //cargo $hours que tiene listado de horas
            for ($actualHour = $sellerDay->from_hour; $actualHour <= $sellerDay->to_hour; $actualHour++) {
                $hours[$actualHour] = $sellerDay->total;//total de disponibilidad simultanea
            }

            $sellerReservations = SellerReservation::where([['seller_day_id', '=', $sellerDay->id]])->get();

            foreach ($sellerReservations as $sellerReservation) {
                for ($actualHour = $sellerReservation->from_hour; $actualHour < $sellerReservation->to_hour; $actualHour++) {
                    $hours[$actualHour] = $hours[$actualHour] - $sellerReservation->total;//de la disponibilidad en la hora se resta segun la reserva ya solicitada
                }
            }
        }

        return array($sellerDay, $hours);
    }

}

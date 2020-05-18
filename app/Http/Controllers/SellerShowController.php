<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\SellerDay;
use App\Models\SellerProduct;
use App\Models\SellerReservation;
use App\Repositories\SellerDayRepository;
use App\Repositories\SellerReservationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

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
        
        $availableDays = array();
        $sellerDay = null;
        $sellerProducts = null;
        $comboSellerProducts = null;

        if($seller->reservations == 2){//admite reservas con turnos (ofrecimiento de servicios, por lo que debe haber una relacion sellerProducts)
            $sellerDays = SellerDay::where([['seller_id', '=', $id], ['date', '>=', DB::raw('CURDATE()')], ['date', '<=', DB::raw('CURDATE() + INTERVAL 1 MONTH')], ['available', '=', 1]])
                ->orderBy('date', 'ASC')->orderBy('from_hour', 'ASC')->get();

            $sellerProducts = SellerProduct::where([['seller_id', '=', $id]])->get();
            $comboSellerProducts = SellerProduct::where([['seller_id', '=', $id]])
                                                ->join('products', 'products.id', '=', 'seller_products.product_id')
                                                ->select('seller_products.*', 'products.*', DB::raw('concat("$", products.price, " - ", products.short_description) as descripcion'))
                                                ->get()
                                                ->pluck('descripcion', 'product_id');

            $seller_day_ids = array();
            
            foreach($sellerDays as $sellerDay){
                array_push($seller_day_ids ,$sellerDay->id);
            }

            $sellerReservations = SellerReservation::whereIn('seller_day_id', $seller_day_ids)->orderBy('seller_day_id', 'ASC')->orderBy('from_hour', 'ASC')->get();
    
            foreach($sellerDays as $sellerDay){
                if($sellerDay->date){
                    $availableDays = $this->agregarDisponibilidad($availableDays, $sellerDay->id, $sellerDay->date, $sellerDay->from_hour, $sellerDay->to_hour, $sellerReservations);
                }
            }
    
            $availableDays = json_encode($availableDays);
        }else{
            $sellerDay = SellerDay::where([['seller_id', '=', $id], ['date', '=', DB::raw('CURDATE()')]])->first();
        }

        $sections = array();

        return view('seller.seller', array('entity_parents' => $entity_parents, 'entity_children' => $entity_children,
            'categories' => $entity_children, 'seller' => $seller, 'availableDays' => $availableDays, 'sellerDay' => $sellerDay,
            'sellerProducts' => $sellerProducts, 'sections' => $sections, 'comboSellerProducts' => $comboSellerProducts));
    }

    public function reservation(Request $request){
        $seller = Seller::find($request->input('seller_id'));
        $number_of_reservations = $request->input('number_of_reservations');
        $day_selected = $request->input('day_selected');

        $sellerDay = SellerDay::where([['seller_id', '=', $seller->id], ['date', '=', $day_selected]])->first();//Verifico si tiene disponibilidad en el dia

        $puedeReservar = $this->checkAvailability($sellerDay, $number_of_reservations);

        return view('seller.reservation', array('seller' => $seller, 'sellerDay' => $sellerDay, 'number_of_reservations' => $number_of_reservations, 
                                                'puedeReservar' => $puedeReservar));
    }

    public function reserve(Request $request){
        $sellerDay = SellerDay::find($request->input('seller_day_id'));
        $number_of_reservations = $request->input('number_of_reservations');
        $from_hour = intval($request->input('hour'));

        $user = Auth::user();

        $sellerReservation = array();
        $sellerReservation['seller_day_id'] = $sellerDay->id;
        $sellerReservation['user_id'] = $user->id;
        $sellerReservation['total'] = $number_of_reservations;
        $sellerReservation['from_hour'] = $from_hour;

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
    private function calculateAvailability($seller, $day_selected){
//        $sellerDay = SellerDay::where([['seller_id', '=', $seller->id], ['date', '=', DB::raw('CURDATE()')]])->first();
        $sellerDay = SellerDay::where([['seller_id', '=', $seller->id], ['date', '=', $day_selected]])->first();

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

    private function checkAvailability($sellerDay, $reservasSolicitadas){
        if($sellerDay){
            $sellerReservations = SellerReservation::where([['seller_day_id', '=', $sellerDay->id]])->get();//Veo todas las reservas realizadas para dicho dia.

            $reservasRealizadas = 0;
            foreach ($sellerReservations as $sellerReservation) {
                $reservasRealizadas += $sellerReservation->total;//cantidad de lugares reservados
            }

            if($reservasSolicitadas <= ($sellerDay->total - $reservasRealizadas)){
                return true;
            }
        }

        return false;
    }

    private function agregarDisponibilidad($availableDays, $sellerDayId, $day, $from_hour, $to_hour, $sellerReservations){
        $day = (new \DateTime($day))->format('Y-m-d');

        //Genera array de horas con from_hour a to_hour
        $horas = array();
        for($hora = $from_hour; $hora < $to_hour; $hora++){
            $horarioReservado = false;
            foreach($sellerReservations as $sellerReservation){
                if($sellerReservation->seller_day_id == $sellerDayId){
                    if($sellerReservation->from_hour == $hora){
                        $horarioReservado = true;
                        break;
                    }
                }
            }
            if(!$horarioReservado){
                array_push($horas, str_pad($hora, 2, '0', STR_PAD_LEFT).':00');//Formatea las horas de 8 a 08:00
            }
        }

        //Crea todos los dias
        if(empty($availableDays[$day])){
            $availableDays[$day] = array();
        }
        
        //agrega las horas en el array de dias
        foreach($horas as $hora){
            array_push($availableDays[$day], $hora);
        }

        //resta las horas ya reservadas del array de dias
        
        return $availableDays;
    }

}

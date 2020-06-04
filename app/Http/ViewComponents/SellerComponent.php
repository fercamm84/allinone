<?php

namespace App\Http\ViewComponents;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Seller;
use App\Models\SellerDay;
use App\Models\SellerProduct;
use App\Models\SellerReservation;
use App\Models\Entity;
use App\Models\Product;

class SellerComponent implements Htmlable
{

    private $request;
    private $entity_id;

    public function __construct(Request $request, string $entity_id)
    {
        $this->request = $request;
        $this->entity_id = $entity_id;
    }

    public function toHtml()
    {
        $entity = Entity::find($this->entity_id);

        $seller = $entity->entidad();

        $id = $seller->id;

        $entity_parents = array();
        array_push($entity_parents, $seller);

        $entity_children = array();

        // foreach ($seller->sellerCategories as $sellerCategory) {
        //     array_push($entity_children, $sellerCategory->category);
        // }
        
        $availableDays = array();
        $sellerDay = null;
        $products = $this->findProducts($seller);

        if($seller->reservations == 2){//admite reservas con turnos (ofrecimiento de servicios, por lo que debe haber una relacion de seller_id en products)
            $sellerDays = SellerDay::where([['seller_id', '=', $id], ['date', '>=', DB::raw('CURDATE()')], ['date', '<=', DB::raw('CURDATE() + INTERVAL 1 MONTH')], ['available', '=', 1]])
                ->orderBy('date', 'ASC')->orderBy('from_hour', 'ASC')->get();

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

        return View::make('components.seller.seller')
            ->with('entity_parents', $entity_parents)
            ->with('entity_children', $entity_children)
            ->with('categories', $entity_children)
            ->with('seller', $seller)
            ->with('availableDays', $availableDays)
            ->with('sellerDay', $sellerDay)
            ->with('products', $products)
            ->with('sections', $sections)
            ->render();
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

        //agrega las horas en el array de dias
        foreach($horas as $hora){
            //Crea el dia
            if(empty($availableDays[$day])){
                $availableDays[$day] = array();
            }
            array_push($availableDays[$day], $hora);
        }

        //resta las horas ya reservadas del array de dias
        
        return $availableDays;
    }

    private function findProducts(Seller $seller){
        $products = Product::where([['seller_id', '=', $seller->id]])->get();
        return $products;
    }

}
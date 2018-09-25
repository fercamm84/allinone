<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Repositories\SellerDayRepository;

class SellerShowController extends Controller
{

    /** @var  SellerDayRepository */
    private $sellerDayRepository;

    public function __construct(SellerDayRepository $sellerDayRepo){
        $this->sellerDayRepository = $sellerDayRepo;
    }

    public function index($id = null){

        $seller = Seller::find($id);

        $entity_parents = array();
        array_push($entity_parents, $seller);

        $entity_children = array();

        foreach ($seller->sellerCategories as $sellerCategory) {
            array_push($entity_children, $sellerCategory->category);
        }

        $sellerDays = $this->sellerDayRepository->all();

        return view('search.search', array('entity_parents' => $entity_parents, 'entity_children' => $entity_children,
            'categories' => $entity_children, 'seller' => $seller, 'sellerDays' => $sellerDays));
    }

}

<?php

namespace App\Repositories;

use App\Models\SellerReservationProduct;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SellerReservationProductRepository
 * @package App\Repositories
 * @version September 23, 2018, 5:25 am UTC
 *
 * @method SellerReservation findWithoutFail($id, $columns = ['*'])
 * @method SellerReservation find($id, $columns = ['*'])
 * @method SellerReservation first($columns = ['*'])
*/
class SellerReservationProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'seller_reservation_id',
        'product_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SellerReservationProduct::class;
    }
}

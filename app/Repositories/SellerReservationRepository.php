<?php

namespace App\Repositories;

use App\Models\SellerReservation;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SellerReservationRepository
 * @package App\Repositories
 * @version September 23, 2018, 5:25 am UTC
 *
 * @method SellerReservation findWithoutFail($id, $columns = ['*'])
 * @method SellerReservation find($id, $columns = ['*'])
 * @method SellerReservation first($columns = ['*'])
*/
class SellerReservationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'seller_day_id',
        'user_id',
        'total',
        'from_hour',
        'to_hour'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SellerReservation::class;
    }
}

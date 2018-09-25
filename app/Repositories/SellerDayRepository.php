<?php

namespace App\Repositories;

use App\Models\SellerDay;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SellerDayRepository
 * @package App\Repositories
 * @version September 23, 2018, 5:24 am UTC
 *
 * @method SellerDay findWithoutFail($id, $columns = ['*'])
 * @method SellerDay find($id, $columns = ['*'])
 * @method SellerDay first($columns = ['*'])
*/
class SellerDayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'seller_id',
        'date',
        'total',
        'available',
        'from_hour',
        'to_hour'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SellerDay::class;
    }
}

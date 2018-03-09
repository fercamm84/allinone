<?php

namespace App\Repositories;

use App\Models\OrderDetail;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderDetailRepository
 * @package App\Repositories
 * @version March 9, 2018, 5:31 am UTC
 *
 * @method OrderDetail findWithoutFail($id, $columns = ['*'])
 * @method OrderDetail find($id, $columns = ['*'])
 * @method OrderDetail first($columns = ['*'])
*/
class OrderDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'volume',
        'order_id',
        'product_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderDetail::class;
    }
}

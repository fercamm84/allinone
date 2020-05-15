<?php

namespace App\Repositories;

use App\Models\SellerProduct;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SellerProductRepository
 * @package App\Repositories
 * @version March 9, 2018, 5:32 am UTC
 *
 * @method SellerProduct findWithoutFail($id, $columns = ['*'])
 * @method SellerProduct find($id, $columns = ['*'])
 * @method SellerProduct first($columns = ['*'])
*/
class SellerProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'seller_id',
        'product_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SellerProduct::class;
    }
}

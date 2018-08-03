<?php

namespace App\Repositories;

use App\Models\Seller;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SellerRepository
 * @package App\Repositories
 * @version August 3, 2018, 3:46 am UTC
 *
 * @method Seller findWithoutFail($id, $columns = ['*'])
 * @method Seller find($id, $columns = ['*'])
 * @method Seller first($columns = ['*'])
*/
class SellerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description',
        'order',
        'type',
        'entity_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Seller::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\ImageProduct;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ImageProductRepository
 * @package App\Repositories
 * @version March 12, 2018, 7:56 pm UTC
 *
 * @method ImageProduct findWithoutFail($id, $columns = ['*'])
 * @method ImageProduct find($id, $columns = ['*'])
 * @method ImageProduct first($columns = ['*'])
*/
class ImageProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'image_id',
        'active'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ImageProduct::class;
    }
}

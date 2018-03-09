<?php

namespace App\Repositories;

use App\Models\CategoryProduct;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CategoryProductRepository
 * @package App\Repositories
 * @version March 9, 2018, 5:32 am UTC
 *
 * @method CategoryProduct findWithoutFail($id, $columns = ['*'])
 * @method CategoryProduct find($id, $columns = ['*'])
 * @method CategoryProduct first($columns = ['*'])
*/
class CategoryProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'product_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CategoryProduct::class;
    }
}

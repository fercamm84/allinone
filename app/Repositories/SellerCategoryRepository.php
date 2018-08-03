<?php

namespace App\Repositories;

use App\Models\SellerCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SellerCategoryRepository
 * @package App\Repositories
 * @version August 3, 2018, 3:47 am UTC
 *
 * @method SellerCategory findWithoutFail($id, $columns = ['*'])
 * @method SellerCategory find($id, $columns = ['*'])
 * @method SellerCategory first($columns = ['*'])
*/
class SellerCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'seller_id',
        'category_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SellerCategory::class;
    }
}

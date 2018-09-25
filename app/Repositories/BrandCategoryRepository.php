<?php

namespace App\Repositories;

use App\Models\BrandCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BrandCategoryRepository
 * @package App\Repositories
 * @version September 17, 2018, 9:34 pm UTC
 *
 * @method BrandCategory findWithoutFail($id, $columns = ['*'])
 * @method BrandCategory find($id, $columns = ['*'])
 * @method BrandCategory first($columns = ['*'])
*/
class BrandCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'brand_id',
        'category_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return BrandCategory::class;
    }
}

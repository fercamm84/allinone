<?php

namespace App\Repositories;

use App\Models\ImageCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ImageCategoryRepository
 * @package App\Repositories
 * @version March 12, 2018, 7:56 pm UTC
 *
 * @method ImageCategory findWithoutFail($id, $columns = ['*'])
 * @method ImageCategory find($id, $columns = ['*'])
 * @method ImageCategory first($columns = ['*'])
*/
class ImageCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'image_id',
        'active'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ImageCategory::class;
    }
}

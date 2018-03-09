<?php

namespace App\Repositories;

use App\Models\CategoryAttribute;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CategoryAttributeRepository
 * @package App\Repositories
 * @version March 9, 2018, 5:32 am UTC
 *
 * @method CategoryAttribute findWithoutFail($id, $columns = ['*'])
 * @method CategoryAttribute find($id, $columns = ['*'])
 * @method CategoryAttribute first($columns = ['*'])
*/
class CategoryAttributeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'attribute_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CategoryAttribute::class;
    }
}

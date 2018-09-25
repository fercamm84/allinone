<?php

namespace App\Repositories;

use App\Models\AttributeValue;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AttributeValueRepository
 * @package App\Repositories
 * @version September 5, 2018, 1:56 am UTC
 *
 * @method AttributeValue findWithoutFail($id, $columns = ['*'])
 * @method AttributeValue find($id, $columns = ['*'])
 * @method AttributeValue first($columns = ['*'])
*/
class AttributeValueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'attribute_id',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AttributeValue::class;
    }
}

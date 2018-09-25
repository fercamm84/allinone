<?php

namespace App\Repositories;

use App\Models\AttributeValueEntity;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AttributeValueEntityRepository
 * @package App\Repositories
 * @version September 24, 2018, 9:29 pm UTC
 *
 * @method AttributeValueEntity findWithoutFail($id, $columns = ['*'])
 * @method AttributeValueEntity find($id, $columns = ['*'])
 * @method AttributeValueEntity first($columns = ['*'])
*/
class AttributeValueEntityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'entity_id',
        'attribute_value_id',
        'amount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AttributeValueEntity::class;
    }
}

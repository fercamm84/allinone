<?php

namespace App\Repositories;

use App\Models\AttributeEntity;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AttributeEntityRepository
 * @package App\Repositories
 * @version August 3, 2018, 2:52 am UTC
 *
 * @method AttributeEntity findWithoutFail($id, $columns = ['*'])
 * @method AttributeEntity find($id, $columns = ['*'])
 * @method AttributeEntity first($columns = ['*'])
*/
class AttributeEntityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'entity_id',
        'attribute_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AttributeEntity::class;
    }
}

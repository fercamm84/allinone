<?php

namespace App\Repositories;

use App\Models\OrderDetailAttributeValueEntity;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderDetailAttributeValueEntityRepository
 * @package App\Repositories
 * @version September 25, 2018, 4:09 am UTC
 *
 * @method OrderDetailAttributeValueEntity findWithoutFail($id, $columns = ['*'])
 * @method OrderDetailAttributeValueEntity find($id, $columns = ['*'])
 * @method OrderDetailAttributeValueEntity first($columns = ['*'])
*/
class OrderDetailAttributeValueEntityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'attribute_value_entity_id',
        'order_detail_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderDetailAttributeValueEntity::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\OrderDetailAttributeValue;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderDetailAttributeValueRepository
 * @package App\Repositories
 * @version September 5, 2018, 5:03 am UTC
 *
 * @method OrderDetailAttributeValue findWithoutFail($id, $columns = ['*'])
 * @method OrderDetailAttributeValue find($id, $columns = ['*'])
 * @method OrderDetailAttributeValue first($columns = ['*'])
*/
class OrderDetailAttributeValueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'attribute_value_id',
        'order_detail_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderDetailAttributeValue::class;
    }
}

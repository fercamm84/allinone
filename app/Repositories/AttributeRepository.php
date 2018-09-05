<?php

namespace App\Repositories;

use App\Models\Attribute;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AttributeRepository
 * @package App\Repositories
 * @version March 9, 2018, 5:29 am UTC
 *
 * @method Attribute findWithoutFail($id, $columns = ['*'])
 * @method Attribute find($id, $columns = ['*'])
 * @method Attribute first($columns = ['*'])
*/
class AttributeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description',
        'order',
        'visible'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Attribute::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\Entity;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EntityRepository
 * @package App\Repositories
 * @version August 1, 2018, 8:19 pm UTC
 *
 * @method Entity findWithoutFail($id, $columns = ['*'])
 * @method Entity find($id, $columns = ['*'])
 * @method Entity first($columns = ['*'])
*/
class EntityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Entity::class;
    }
}

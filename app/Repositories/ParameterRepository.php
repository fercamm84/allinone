<?php

namespace App\Repositories;

use App\Models\Parameter;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ParameterRepository
 * @package App\Repositories
 * @version February 19, 2018, 1:01 am UTC
 *
 * @method Parameter findWithoutFail($id, $columns = ['*'])
 * @method Parameter find($id, $columns = ['*'])
 * @method Parameter first($columns = ['*'])
*/
class ParameterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'field',
        'value',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Parameter::class;
    }
}

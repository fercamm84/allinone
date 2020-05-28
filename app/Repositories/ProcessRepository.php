<?php

namespace App\Repositories;

use App\Models\Process;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProcessRepository
 * @package App\Repositories
 * @version July 23, 2018, 4:34 pm UTC
 *
 * @method Process findWithoutFail($id, $columns = ['*'])
 * @method Process find($id, $columns = ['*'])
 * @method Process first($columns = ['*'])
*/
class ProcessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'comment',
        'type',
        'state',
        'process',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Process::class;
    }
}

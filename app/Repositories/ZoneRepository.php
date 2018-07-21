<?php

namespace App\Repositories;

use App\Models\Zone;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ZoneRepository
 * @package App\Repositories
 * @version June 7, 2018, 2:37 am UTC
 *
 * @method Zone findWithoutFail($id, $columns = ['*'])
 * @method Zone find($id, $columns = ['*'])
 * @method Zone first($columns = ['*'])
*/
class ZoneRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'zone',
        'country_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Zone::class;
    }
}

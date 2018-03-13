<?php

namespace App\Repositories;

use App\Models\Section;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SectionRepository
 * @package App\Repositories
 * @version March 12, 2018, 7:57 pm UTC
 *
 * @method Section findWithoutFail($id, $columns = ['*'])
 * @method Section find($id, $columns = ['*'])
 * @method Section first($columns = ['*'])
*/
class SectionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Section::class;
    }
}

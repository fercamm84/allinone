<?php

namespace App\Repositories;

use App\Models\SectionEntity;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SectionEntityRepository
 * @package App\Repositories
 * @version August 1, 2018, 8:21 pm UTC
 *
 * @method SectionEntity findWithoutFail($id, $columns = ['*'])
 * @method SectionEntity find($id, $columns = ['*'])
 * @method SectionEntity first($columns = ['*'])
*/
class SectionEntityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'entity_id',
        'section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SectionEntity::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\ImageEntity;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ImageEntityRepository
 * @package App\Repositories
 * @version August 2, 2018, 3:01 am UTC
 *
 * @method ImageEntity findWithoutFail($id, $columns = ['*'])
 * @method ImageEntity find($id, $columns = ['*'])
 * @method ImageEntity first($columns = ['*'])
*/
class ImageEntityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'entity_id',
        'image_id',
        'active'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ImageEntity::class;
    }
}

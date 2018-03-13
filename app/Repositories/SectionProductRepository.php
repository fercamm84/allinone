<?php

namespace App\Repositories;

use App\Models\SectionProduct;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SectionProductRepository
 * @package App\Repositories
 * @version March 12, 2018, 7:58 pm UTC
 *
 * @method SectionProduct findWithoutFail($id, $columns = ['*'])
 * @method SectionProduct find($id, $columns = ['*'])
 * @method SectionProduct first($columns = ['*'])
*/
class SectionProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'section_id',
        'active'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SectionProduct::class;
    }
}

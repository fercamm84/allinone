<?php

namespace App\Repositories;

use App\Models\SectionCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SectionCategoryRepository
 * @package App\Repositories
 * @version March 12, 2018, 7:57 pm UTC
 *
 * @method SectionCategory findWithoutFail($id, $columns = ['*'])
 * @method SectionCategory find($id, $columns = ['*'])
 * @method SectionCategory first($columns = ['*'])
*/
class SectionCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'section_id',
        'active'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SectionCategory::class;
    }
}

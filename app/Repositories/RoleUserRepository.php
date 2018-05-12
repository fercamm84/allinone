<?php

namespace App\Repositories;

use App\Models\RoleUser;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RoleUserRepository
 * @package App\Repositories
 * @version May 12, 2018, 2:57 am UTC
 *
 * @method RoleUser findWithoutFail($id, $columns = ['*'])
 * @method RoleUser find($id, $columns = ['*'])
 * @method RoleUser first($columns = ['*'])
*/
class RoleUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'role_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RoleUser::class;
    }
}

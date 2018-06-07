<?php

namespace App\Repositories;

use App\Models\UserAddress;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserAddressRepository
 * @package App\Repositories
 * @version June 7, 2018, 2:43 am UTC
 *
 * @method UserAddress findWithoutFail($id, $columns = ['*'])
 * @method UserAddress find($id, $columns = ['*'])
 * @method UserAddress first($columns = ['*'])
*/
class UserAddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'address_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserAddress::class;
    }
}

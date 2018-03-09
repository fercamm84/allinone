<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version March 9, 2018, 5:03 am UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'user_type',
        'twitter_id',
        'facebook_id',
        'created',
        'remember_token',
        'nickname',
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\Mailing;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MailingRepository
 * @package App\Repositories
 * @version July 23, 2018, 4:34 pm UTC
 *
 * @method Mailing findWithoutFail($id, $columns = ['*'])
 * @method Mailing find($id, $columns = ['*'])
 * @method Mailing first($columns = ['*'])
*/
class MailingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'comments',
        'email',
        'user_id',
        'country_id',
        'telephone',
        'first_name',
        'last_name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Mailing::class;
    }
}

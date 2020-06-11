<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Notifiable;

/**
 * Class User
 * @package App\Models
 * @version March 9, 2018, 5:03 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection tickers
 * @property string firstname
 * @property string lastname
 * @property string email
 * @property string password
 * @property integer user_type
 * @property integer twitter_id
 * @property integer facebook_id
 * @property string|\Carbon\Carbon created
 * @property string remember_token
 * @property string nickname
 * @property string name
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'firstname' => 'string',
        'lastname' => 'string',
        'email' => 'string',
        'password' => 'string',
        'user_type' => 'integer',
        'twitter_id' => 'integer',
        'facebook_id' => 'integer',
        'remember_token' => 'string',
        'nickname' => 'string',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function roleUsers()
    {
        return $this->hasMany(\App\Models\RoleUser::class);
    }
    
}

<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mailing
 * @package App\Models
 * @version July 23, 2018, 4:34 pm UTC
 *
 * @property \App\Models\Country country
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection categoryAttributes
 * @property \Illuminate\Database\Eloquent\Collection imageCategories
 * @property \Illuminate\Database\Eloquent\Collection imageProducts
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property \Illuminate\Database\Eloquent\Collection roleUsers
 * @property \Illuminate\Database\Eloquent\Collection sectionCategories
 * @property \Illuminate\Database\Eloquent\Collection sectionProducts
 * @property \Illuminate\Database\Eloquent\Collection userAddresses
 * @property string comments
 * @property string email
 * @property integer user_id
 * @property integer country_id
 * @property string telephone
 * @property string first_name
 * @property string last_name
 */
class Mailing extends Model
{
    use SoftDeletes;

    public $table = 'mailings';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'comments',
        'email',
        'user_id',
        'country_id',
        'telephone',
        'first_name',
        'last_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'comments' => 'string',
        'email' => 'string',
        'user_id' => 'integer',
        'country_id' => 'integer',
        'telephone' => 'string',
        'first_name' => 'string',
        'last_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

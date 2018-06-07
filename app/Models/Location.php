<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Location
 * @package App\Models
 * @version June 7, 2018, 2:42 am UTC
 *
 * @property \App\Models\City city
 * @property \Illuminate\Database\Eloquent\Collection Address
 * @property \Illuminate\Database\Eloquent\Collection categoryAttributes
 * @property \Illuminate\Database\Eloquent\Collection categoryProducts
 * @property \Illuminate\Database\Eloquent\Collection imageCategories
 * @property \Illuminate\Database\Eloquent\Collection imageProducts
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property \Illuminate\Database\Eloquent\Collection roleUsers
 * @property \Illuminate\Database\Eloquent\Collection sectionCategories
 * @property \Illuminate\Database\Eloquent\Collection sectionProducts
 * @property \Illuminate\Database\Eloquent\Collection userAddresses
 * @property string description
 * @property integer city_id
 */
class Location extends Model
{
    use SoftDeletes;

    public $table = 'locations';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'description',
        'city_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'city_id' => 'integer'
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
    public function city()
    {
        return $this->belongsTo(\App\Models\City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function addresses()
    {
        return $this->hasMany(\App\Models\Address::class);
    }
}

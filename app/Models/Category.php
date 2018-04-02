<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 * @version March 9, 2018, 5:33 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection CategoryAttribute
 * @property \Illuminate\Database\Eloquent\Collection CategoryProduct
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property string description
 * @property integer order
 * @property integer parent_id
 */
class Category extends Model
{
    use SoftDeletes;

    public $table = 'categories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'description',
        'order',
        'type',
        'parent_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'order' => 'integer',
        'type' => 'string',
        'parent_id' => 'integer'
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
    public function categoryAttributes()
    {
        return $this->hasMany(\App\Models\CategoryAttribute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function categoryProducts()
    {
        return $this->hasMany(\App\Models\CategoryProduct::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function imageCategories()
    {
        return $this->hasMany(\App\Models\ImageCategory::class);
    }

}

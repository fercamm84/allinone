<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version March 9, 2018, 5:30 am UTC
 *
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection categoryAttributes
 * @property \Illuminate\Database\Eloquent\Collection CategoryProduct
 * @property \Illuminate\Database\Eloquent\Collection OrderDetail
 * @property string description
 * @property string short_description
 * @property string title
 * @property float price
 * @property string name
 * @property integer order
 * @property boolean visible
 * @property integer stock
 * @property integer user_id
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'description',
        'short_description',
        'title',
        'price',
        'name',
        'order',
        'visible',
        'stock',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'short_description' => 'string',
        'title' => 'string',
        'price' => 'float',
        'name' => 'string',
        'order' => 'integer',
        'visible' => 'boolean',
        'stock' => 'integer',
        'user_id' => 'integer'
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
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
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
    public function orderDetails()
    {
        return $this->hasMany(\App\Models\OrderDetail::class);
    }
}

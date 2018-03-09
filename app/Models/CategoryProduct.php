<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CategoryProduct
 * @package App\Models
 * @version March 9, 2018, 5:32 am UTC
 *
 * @property \App\Models\Category category
 * @property \App\Models\Product product
 * @property \Illuminate\Database\Eloquent\Collection categoryAttributes
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property integer category_id
 * @property integer product_id
 */
class CategoryProduct extends Model
{
    use SoftDeletes;

    public $table = 'category_products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'category_id',
        'product_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'product_id' => 'integer'
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
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}

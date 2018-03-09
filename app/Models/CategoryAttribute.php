<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CategoryAttribute
 * @package App\Models
 * @version March 9, 2018, 5:32 am UTC
 *
 * @property \App\Models\Attribute attribute
 * @property \App\Models\Category category
 * @property \Illuminate\Database\Eloquent\Collection categoryProducts
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property integer category_id
 * @property integer attribute_id
 */
class CategoryAttribute extends Model
{
    use SoftDeletes;

    public $table = 'category_attributes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'category_id',
        'attribute_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'attribute_id' => 'integer'
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
    public function attribute()
    {
        return $this->belongsTo(\App\Models\Attribute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}

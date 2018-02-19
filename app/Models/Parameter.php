<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Parameter
 * @package App\Models
 * @version February 19, 2018, 1:01 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection tickers
 * @property string field
 * @property string value
 * @property string description
 */
class Parameter extends Model
{
    use SoftDeletes;

    public $table = 'parameters';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'field',
        'value',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'field' => 'string',
        'value' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}

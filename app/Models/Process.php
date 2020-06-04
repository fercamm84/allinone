<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Process
 * @package App\Models
 * @version July 23, 2018, 4:34 pm UTC
 *
 * @property \App\Models\User user
 * @property string process
 * @property string state
 * @property string comment
 */
class Process extends Model
{
    use SoftDeletes;

    public $table = 'processes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'process',
        'type',
        'state',
        'comment',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'state' => 'string',
        'type' => 'string',
        'comment' => 'string',
        'process' => 'string',
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
}

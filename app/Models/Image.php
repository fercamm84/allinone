<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Image
 * @package App\Models
 * @version March 12, 2018, 7:54 pm UTC
 *
 * @property string type
 * @property string name
 */
class Image extends Model
{
    use SoftDeletes;

    public $table = 'images';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'type',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
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
    public function imageEntities()
    {
        return $this->hasMany(\App\Models\ImageEntity::class);
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($image) {
            $image->imageEntities()->delete();
        });
    }

}

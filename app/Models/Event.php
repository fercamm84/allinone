<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 * @package App\Models
 * @version August 3, 2018, 3:48 am UTC
 *
 * @property \App\Models\Entity entity
 * @property \Illuminate\Database\Eloquent\Collection attributeEntities
 * @property \Illuminate\Database\Eloquent\Collection categories
 * @property \Illuminate\Database\Eloquent\Collection categoryProducts
 * @property \Illuminate\Database\Eloquent\Collection imageEntities
 * @property \Illuminate\Database\Eloquent\Collection mailings
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property \Illuminate\Database\Eloquent\Collection products
 * @property \Illuminate\Database\Eloquent\Collection roleUsers
 * @property \Illuminate\Database\Eloquent\Collection sectionEntities
 * @property \Illuminate\Database\Eloquent\Collection sellerCategories
 * @property \Illuminate\Database\Eloquent\Collection userAddresses
 * @property string description
 * @property integer order
 * @property string type
 * @property integer entity_id
 */
class Event extends Model
{
    use SoftDeletes;

    public $table = 'events';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'description',
        'order',
        'type',
        'entity_id'
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
        'entity_id' => 'integer'
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
    public function entity()
    {
        return $this->belongsTo(\App\Models\Entity::class);
    }
}

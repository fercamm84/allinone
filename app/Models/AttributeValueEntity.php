<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AttributeValueEntity
 * @package App\Models
 * @version September 24, 2018, 9:29 pm UTC
 *
 * @property \App\Models\AttributeValue attributeValue
 * @property \App\Models\Entity entity
 * @property \Illuminate\Database\Eloquent\Collection brandCategories
 * @property \Illuminate\Database\Eloquent\Collection categories
 * @property \Illuminate\Database\Eloquent\Collection categoryProducts
 * @property \Illuminate\Database\Eloquent\Collection imageEntities
 * @property \Illuminate\Database\Eloquent\Collection mailings
 * @property \Illuminate\Database\Eloquent\Collection orderDetailAttributeValues
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property \Illuminate\Database\Eloquent\Collection products
 * @property \Illuminate\Database\Eloquent\Collection roleUsers
 * @property \Illuminate\Database\Eloquent\Collection sectionEntities
 * @property \Illuminate\Database\Eloquent\Collection sellerCategories
 * @property \Illuminate\Database\Eloquent\Collection sellerReservations
 * @property \Illuminate\Database\Eloquent\Collection userAddresses
 * @property integer entity_id
 * @property integer attribute_value_id
 * @property decimal amount
 */
class AttributeValueEntity extends Model
{
    use SoftDeletes;

    public $table = 'attribute_value_entities';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'entity_id',
        'attribute_value_id',
        'amount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'entity_id' => 'integer',
        'attribute_value_id' => 'integer'
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
    public function attributeValue()
    {
        return $this->belongsTo(\App\Models\AttributeValue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function entity()
    {
        return $this->belongsTo(\App\Models\Entity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function orderDetailAttributeValueEntities()
    {
        return $this->hasMany(\App\Models\OrderDetailAttributeValueEntity::class);
    }


}

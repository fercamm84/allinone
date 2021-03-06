<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderDetailAttributeValueEntity
 * @package App\Models
 * @version September 25, 2018, 4:09 am UTC
 *
 * @property \App\Models\AttributeValueEntity attributeValueEntity
 * @property \App\Models\OrderDetail orderDetail
 * @property \Illuminate\Database\Eloquent\Collection attributeValueEntities
 * @property \Illuminate\Database\Eloquent\Collection brandCategories
 * @property \Illuminate\Database\Eloquent\Collection categories
 * @property \Illuminate\Database\Eloquent\Collection imageEntities
 * @property \Illuminate\Database\Eloquent\Collection mailings
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property \Illuminate\Database\Eloquent\Collection products
 * @property \Illuminate\Database\Eloquent\Collection roleUsers
 * @property \Illuminate\Database\Eloquent\Collection sectionEntities
 * @property \Illuminate\Database\Eloquent\Collection sellerCategories
 * @property \Illuminate\Database\Eloquent\Collection sellerReservations
 * @property \Illuminate\Database\Eloquent\Collection userAddresses
 * @property integer attribute_value_entity_id
 * @property integer order_detail_id
 */
class OrderDetailAttributeValueEntity extends Model
{
    use SoftDeletes;

    public $table = 'order_detail_attribute_value_entities';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'attribute_value_entity_id',
        'order_detail_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'attribute_value_entity_id' => 'integer',
        'order_detail_id' => 'integer'
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
    public function attributeValueEntity()
    {
        return $this->belongsTo(\App\Models\AttributeValueEntity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function orderDetail()
    {
        return $this->belongsTo(\App\Models\OrderDetail::class);
    }
}

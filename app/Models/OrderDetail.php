<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderDetail
 * @package App\Models
 * @version March 9, 2018, 5:31 am UTC
 *
 * @property \App\Models\Order order
 * @property \App\Models\Product product
 * @property \Illuminate\Database\Eloquent\Collection categoryAttributes
 * @property \Illuminate\Database\Eloquent\Collection categoryProducts
 * @property integer volume
 * @property integer order_id
 * @property integer product_id
 */
class OrderDetail extends Model
{
    use SoftDeletes;

    public $table = 'order_details';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'volume',
        'order_id',
        'product_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'volume' => 'integer',
        'order_id' => 'integer',
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
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function orderDetailAttributeValueEntities()
    {
        return $this->hasMany(\App\Models\OrderDetailAttributeValueEntity::class);
    }

    protected static function boot() {
        parent::boot();

        static::deleted(function($orderDetail) {
            foreach($orderDetail->orderDetailAttributeValueEntities as $orderDetailAttributeValueEntity){
                $orderDetailAttributeValueEntity->delete();
            }
        });
    }

    public function total(){
        $attribute_value_total = 0;
        foreach($this->orderDetailAttributeValueEntities as $orderDetailAttributeValueEntity){
            $attribute_value_total += $orderDetailAttributeValueEntity->attributeValueEntity->amount;
        }

        return ($this->volume * ($this->product->price + $attribute_value_total));
    }

    public function unitPrice(){
        $attribute_value_total = 0;
        foreach($this->orderDetailAttributeValueEntities as $orderDetailAttributeValueEntity){
            $attribute_value_total += $orderDetailAttributeValueEntity->attributeValueEntity->amount;
        }

        return $this->product->price + $attribute_value_total;
    }

}

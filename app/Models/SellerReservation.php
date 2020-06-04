<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SellerReservation
 * @package App\Models
 * @version September 23, 2018, 5:25 am UTC
 *
 * @property \App\Models\SellerDay sellerDay
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection attributeEntities
 * @property \Illuminate\Database\Eloquent\Collection brandCategories
 * @property \Illuminate\Database\Eloquent\Collection categories
 * @property \Illuminate\Database\Eloquent\Collection imageEntities
 * @property \Illuminate\Database\Eloquent\Collection mailings
 * @property \Illuminate\Database\Eloquent\Collection orderDetailAttributeValues
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property \Illuminate\Database\Eloquent\Collection products
 * @property \Illuminate\Database\Eloquent\Collection roleUsers
 * @property \Illuminate\Database\Eloquent\Collection sectionEntities
 * @property \Illuminate\Database\Eloquent\Collection sellerCategories
 * @property \Illuminate\Database\Eloquent\Collection userAddresses
 * @property integer seller_day_id
 * @property integer user_id
 * @property integer total
 * @property integer from_hour
 * @property integer to_hour
 */
class SellerReservation extends Model
{
    use SoftDeletes;

    public $table = 'seller_reservations';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'seller_day_id',
        'user_id',
        'total',
        'from_hour',
        'to_hour',
        'order_detail_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'seller_day_id' => 'integer',
        'user_id' => 'integer',
        'total' => 'integer',
        'from_hour' => 'integer',
        'to_hour' => 'integer',
        'order_detail_id' => 'integer',
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
    public function sellerDay()
    {
        return $this->belongsTo(\App\Models\SellerDay::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function orderDetail()
    {
        return $this->belongsTo(\App\Models\OrderDetail::class);
    }

}

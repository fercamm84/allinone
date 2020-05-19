<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SellerDay
 * @package App\Models
 * @version September 23, 2018, 5:24 am UTC
 *
 * @property \App\Models\Seller seller
 * @property \Illuminate\Database\Eloquent\Collection attributeEntities
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
 * @property \Illuminate\Database\Eloquent\Collection SellerReservation
 * @property \Illuminate\Database\Eloquent\Collection userAddresses
 * @property integer seller_id
 * @property date date
 * @property integer total
 * @property boolean available
 * @property integer from_hour
 * @property integer to_hour
 */
class SellerDay extends Model
{
    use SoftDeletes;

    public $table = 'seller_days';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'seller_id',
        'date',
        'total',
        'available',
        'from_hour',
        'to_hour'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'seller_id' => 'integer',
        'date' => 'date',
        'total' => 'integer',
        'available' => 'boolean',
        'from_hour' => 'integer',
        'to_hour' => 'integer'
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
    public function seller()
    {
        return $this->belongsTo(\App\Models\Seller::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function sellerReservations()
    {
        return $this->hasMany(\App\Models\SellerReservation::class);
    }
    
}

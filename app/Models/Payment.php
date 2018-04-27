<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 * @package App\Models
 * @version April 27, 2018, 3:47 am UTC
 *
 * @property \App\Models\Order order
 * @property \Illuminate\Database\Eloquent\Collection categoryAttributes
 * @property \Illuminate\Database\Eloquent\Collection categoryProducts
 * @property \Illuminate\Database\Eloquent\Collection imageCategories
 * @property \Illuminate\Database\Eloquent\Collection imageProducts
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property \Illuminate\Database\Eloquent\Collection sectionCategories
 * @property \Illuminate\Database\Eloquent\Collection sectionProducts
 * @property integer order_id
 * @property string state
 * @property decimal amount
 * @property integer merchant_order_id
 * @property decimal total_paid_amount
 * @property string status_detail
 * @property string payment_type
 * @property string operation_type
 * @property integer payment_id
 * @property string preapproval_id
 */
class Payment extends Model
{
    use SoftDeletes;

    public $table = 'payments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'order_id',
        'state',
        'amount',
        'merchant_order_id',
        'total_paid_amount',
        'status_detail',
        'payment_type',
        'operation_type',
        'payment_id',
        'preapproval_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'state' => 'string',
        'merchant_order_id' => 'integer',
        'status_detail' => 'string',
        'payment_type' => 'string',
        'operation_type' => 'string',
        'payment_id' => 'integer',
        'preapproval_id' => 'string'
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
}

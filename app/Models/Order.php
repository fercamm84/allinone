<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * @package App\Models
 * @version March 9, 2018, 5:30 am UTC
 *
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection categoryAttributes
 * @property \Illuminate\Database\Eloquent\Collection OrderDetail
 * @property integer user_id
 * @property string commentary
 * @property float shipping
 * @property float total
 * @property integer state
 */
class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'commentary',
        'shipping',
        'total',
        'state'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'commentary' => 'string',
        'shipping' => 'float',
        'total' => 'float',
        'state' => 'integer'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function orderDetails()
    {
        return $this->hasMany(\App\Models\OrderDetail::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class);
    }

    public function total(){
        $total = 0;
        foreach($this->orderDetails as $orderDetail){
            $total += $orderDetail->total();
        }

        return $total;
    }

}

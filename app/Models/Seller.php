<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Seller
 * @package App\Models
 * @version August 3, 2018, 3:46 am UTC
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
 * @property \Illuminate\Database\Eloquent\Collection SellerCategory
 * @property \Illuminate\Database\Eloquent\Collection userAddresses
 * @property string description
 * @property integer order
 * @property string type
 * @property integer entity_id
 */
class Seller extends Model
{
    use SoftDeletes;

    public $table = 'sellers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'description',
        'order',
        'type',
        'entity_id',
        'reservations',
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
        'reservations' => 'boolean',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function sellerCategories()
    {
        return $this->hasMany(\App\Models\SellerCategory::class);
    }

    protected static function boot() {
        parent::boot();

        static::saving(function($seller) {
            if($seller->entity_id == null){
                $entity = new Entity();
                $entity->type = 'seller';
                $entity->save();
                $seller->entity_id = $entity->id;
            }
        });

        static::deleted(function($seller) {
            $seller->entity()->delete();
        });
    }

    public function url(){
        return 'seller';
    }

    public function getClassType(){
        return 'seller';
    }

}

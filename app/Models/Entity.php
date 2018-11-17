<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Entity
 * @package App\Models
 * @version August 1, 2018, 8:19 pm UTC
 *
 * @property \App\Models\Location location
 * @property \Illuminate\Database\Eloquent\Collection Category
 * @property \Illuminate\Database\Eloquent\Collection attributeEntities
 * @property \Illuminate\Database\Eloquent\Collection ImageEntity
 * @property \Illuminate\Database\Eloquent\Collection AttributeValueEntity
 * @property \Illuminate\Database\Eloquent\Collection mailings
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property \Illuminate\Database\Eloquent\Collection Product
 * @property \Illuminate\Database\Eloquent\Collection roleUsers
 * @property \Illuminate\Database\Eloquent\Collection SectionEntity
 * @property \Illuminate\Database\Eloquent\Collection userAddresses
 * @property string type
 */
class Entity extends Model
{
    use SoftDeletes;

    public $table = 'entities';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'type',
        'location_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'location_id' => 'integer'
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
    public function categories()
    {
        return $this->hasMany(\App\Models\Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function imageEntities()
    {
        return $this->hasMany(\App\Models\ImageEntity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function attributeValueEntities()
    {
        return $this->hasMany(\App\Models\AttributeValueEntity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function sellers()
    {
        return $this->hasMany(\App\Models\Seller::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function brands()
    {
        return $this->hasMany(\App\Models\Brand::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function news()
    {
        return $this->hasMany(\App\Models\News::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function events()
    {
        return $this->hasMany(\App\Models\Event::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function sectionEntities()
    {
        return $this->hasMany(\App\Models\SectionEntity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class);
    }

    public function entidad(){
        if($this->type == 'category'){
            return $this->categories[0];
        }
        if($this->type == 'product'){
            return $this->products[0];
        }
        if($this->type == 'seller'){
            return $this->sellers[0];
        }
        if($this->type == 'brand'){
            return $this->brands[0];
        }
        if($this->type == 'news'){
            return $this->news[0];
        }
        if($this->type == 'event'){
            return $this->events[0];
        }
    }

}

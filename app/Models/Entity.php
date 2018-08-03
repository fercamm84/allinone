<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Entity
 * @package App\Models
 * @version August 1, 2018, 8:19 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Category
 * @property \Illuminate\Database\Eloquent\Collection attributeEntities
 * @property \Illuminate\Database\Eloquent\Collection ImageEntity
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
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string'
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
    public function attributeEntities()
    {
        return $this->hasMany(\App\Models\AttributeEntity::class);
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
    public function sectionEntities()
    {
        return $this->hasMany(\App\Models\SectionEntity::class);
    }

    public function entidad(){
        if($this->type == 'category'){
            return $this->categories[0];
        }
        if($this->type == 'product'){
            return $this->products[0];
        }
    }

}

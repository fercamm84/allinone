<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 * @version March 9, 2018, 5:29 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection AttributeEntity
 * @property \Illuminate\Database\Eloquent\Collection AttributeValue
 * @property \Illuminate\Database\Eloquent\Collection categoryProducts
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property string descripcion
 * @property integer order
 * @property boolean visible
 */
class Attribute extends Model
{
    use SoftDeletes;

    public $table = 'attributes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'description',
        'order',
        'visible'
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
        'visible' => 'boolean'
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
    public function attributeEntities()
    {
        return $this->hasMany(\App\Models\AttributeEntity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function attributeValues()
    {
        return $this->hasMany(\App\Models\AttributeValue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function entity()
    {
        return $this->belongsTo(\App\Models\Entity::class);
    }

    protected static function boot() {
        parent::boot();

        static::saving(function($attribute) {
            if($attribute->entity_id == null){
                $entity = new Entity();
                $entity->type = 'attribute';
                $entity->save();
                $attribute->entity_id = $entity->id;
            }
        });

        static::deleted(function($attribute) {
            $attribute->entity()->delete();
        });
    }

    public function url(){
        return 'attr';
    }

    public function getClassType(){
        return 'attribute';
    }

}

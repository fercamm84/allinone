<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 * @version March 9, 2018, 5:33 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection CategoryAttribute
 * @property \Illuminate\Database\Eloquent\Collection CategoryProduct
 * @property \Illuminate\Database\Eloquent\Collection orderDetails
 * @property string description
 * @property integer order
 * @property integer parent_id
 * @property integer entity_id
 */
class Category extends Model
{
    use SoftDeletes;

    public $table = 'categories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'description',
        'order',
        'type',
        'parent_id',
        'entity_id'
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
        'type' => 'string',
        'parent_id' => 'integer',
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
    public function categoryProducts()
    {
        return $this->hasMany(\App\Models\CategoryProduct::class);
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

        static::saving(function($category) {
            if($category->entity_id == null) {
                $entity = new Entity();
                $entity->type = 'category';
                $entity->save();
                $category->entity_id = $entity->id;
            }
        });

        static::deleted(function($category) {
            $category->entity()->delete();
        });
    }

    public function url(){
        return 'cat';
    }

    public function getClassType(){
        return 'category';
    }

}

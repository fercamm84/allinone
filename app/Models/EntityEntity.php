<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EntityEntity
 * @package App\Models
 * @version March 9, 2018, 5:32 am UTC
 *
 * @property \App\Models\Entity parent_entity
 * @property \App\Models\Entity entity
 * @property integer parent_entity_id
 * @property integer entity_id
 */
class EntityEntity extends Model
{
    use SoftDeletes;

    public $table = 'entity_entities';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'parent_entity_id',
        'entity_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_entity_id' => 'integer',
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
    public function parent_entity()
    {
        return $this->belongsTo(\App\Models\Entity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    private function entity()
    {
        return $this->belongsTo(\App\Models\Entity::class);
    }
    public function child_entity(){
        return $this->entity();
    }

}

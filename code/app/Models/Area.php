<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable=["name", "city_id", "state_id"];
	
	protected $table = "areas";


    
    
    /**
     * Area has many Addresses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = area_id, localKey = id)
        return $this->hasMany(Address::class,'area_id','id');
    }
    
    /**
     *  Area belongs to City.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        // belongsTo(RelatedModel, foreignKey = city_id, keyOnRelatedModel = id)
        return $this->belongsTo(City::class,'city_id','id');
    }
    /**
     *  Area belongs to State.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        // belongsTo(RelatedModel, foreignKey = state_id, keyOnRelatedModel = id)
        return $this->belongsTo(State::class,'state_id','id');
    }
}

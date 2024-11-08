<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable=["name", "state_id"];
	
	protected $table = "cities";


    
    
    /**
     * City has many Addresses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = city_id, localKey = id)
        return $this->hasMany(Address::class,'city_id','id');
    }
    
    /**
     *  City belongs to State.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        // belongsTo(RelatedModel, foreignKey = state_id, keyOnRelatedModel = id)
        return $this->belongsTo(State::class,'state_id','id');
    }
}

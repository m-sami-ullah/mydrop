<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable=["name", "country_id"];
	
	protected $table = "states";


    
    
    /**
     * State has many Addresses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = state_id, localKey = id)
        return $this->hasMany(Address::class,'state_id','id');
    }
    
    /**
     *  State belongs to Country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        // belongsTo(RelatedModel, foreignKey = country_id, keyOnRelatedModel = id)
        return $this->belongsTo(Country::class,'country_id','id');
    }    
}

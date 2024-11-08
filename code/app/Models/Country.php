<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable=["name", "iso", "nicename", "iso3", "numcode", "phonecode"];
	
	protected $table = "countries";


    
    
    /**
     * Country has many States.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = country_id, localKey = id)
        return $this->hasMany(State::class,'country_id','id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable=["name","available", "package_id"];
	
	protected $table = "features";


    public function isAvailable()
    {
        return $this->available ==1 ? 'Yes':'No'; 
    }
    
    /**
     *  Feature belongs to Package.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        // belongsTo(RelatedModel, foreignKey = package_id, keyOnRelatedModel = id)
        return $this->belongsTo(Package::class,'package_id','id');
    }

    public function availability()
    {
        return $this->available == 1 ? 'uil-check' : 'uil-times bullet-soft-red';
    }
}

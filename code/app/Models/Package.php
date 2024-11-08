<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable=["name","slug", "description", "price", "duration"];
	/*const DURATION_SELECT = [ 
				'1' => 'Monthly',
				'2' => '6 Month',
				'3' => '1 Year',
			];*/

	protected $table = "packages";

    
    
    
    /**
     * Package has many Features.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function features()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = package_id, localKey = id)
        return $this->hasMany(Feature::class,'package_id','id');
    }
    
}

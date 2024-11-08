<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionModule extends Model
{
    protected $fillable=["name", "key"];
	
	protected $table = "permissionmodules";


    
    
    /**
     * Permissionmodule has many Permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = permissionmodule_id, localKey = id)
        return $this->hasMany(Permission::class,'module_id','id');
    }
    
}

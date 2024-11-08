<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable=["name", "function", "module_id"];
	
	protected $table = "permissions";


    
    
    /**
    * Permission belongs to many (many-to-many) Group.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function group_permission()
    {
        // belongsToMany(RelatedModel, pivotTable, thisKeyOnPivot = permission_id, otherKeyOnPivot = group_id)
        return $this->belongsToMany(Group::class,'group_permission','permission_id','group_id');
    }
   
    /**
     *  Permission belongs to Permissionmodule.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        // belongsTo(RelatedModel, foreignKey = permissionmodule_id, keyOnRelatedModel = id)
        return $this->belongsTo(Permissionmodule::class,'module_id','id');
    }
	public function scopeKey($query,$module,$key,$groups)
	{
		$query->where("function",$key)
		->join("permissionmodules","permissions.module_id","=","permissionmodules.id")
		->join("group_permission","group_permission.permission_id","=","permissions.id")
		->where("permissionmodules.key",$module)
		->where("group_permission.status",1)
		->whereIn("group_permission.group_id",$groups);
	}
}

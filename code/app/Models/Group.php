<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable=["name", "status"];
	const STATUS_SELECT = [ 
				'1' => 'Active',
				'2' => 'Inactive',
			];

	protected $table = "groups";


    
    
    /**
    * Group belongs to many (many-to-many) User.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function group_user()
    {
        // belongsToMany(RelatedModel, pivotTable, thisKeyOnPivot = group_id, otherKeyOnPivot = user_id)
        return $this->belongsToMany(User::class,'group_user','group_id','user_id');
    }
    
    /**
    * Group belongs to many (many-to-many) Permission.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function group_permission()
    {
        // belongsToMany(RelatedModel, pivotTable, thisKeyOnPivot = group_id, otherKeyOnPivot = permission_id)
        return $this->belongsToMany(Permission::class,'group_permission','group_id','permission_id')->withPivot(["status"]);;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group_permission extends Model
{
    protected $fillable=["group_id", "permission_id", "status"];
	
	protected $table = "group_permission";


    
    
}

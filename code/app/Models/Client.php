<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable=["name", "logo"];
	
	protected $table = "clients";

	/**
	 * Query scope enabled.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	/*public function scopeEnabled($query)
	{
		return $query->where('status',1);
	}*/
    
    
	public function getlogo()
	{
		return empty($this->logo) ? asset("default/no-image.png"):asset("images/client/".$this->logo);
	}

}

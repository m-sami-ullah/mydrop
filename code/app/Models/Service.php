<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable=["title", "short", "description", "slug", "image","banner", "status"];
	const STATUS_SELECT = [ 
				'1' => 'Enable',
				'2' => 'Disable',
			];

	protected $table = "services";

	/**
	 * Query scope enabled.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeEnabled($query)
	{
		return $query->where('status',1);
	}
    
    
	public function getimage()
	{
		return empty($this->image) ? asset("default/no-image.png"):asset("images/service/".$this->image);
	}

	public function getbanner()
	{
		return empty($this->banner) ? '':asset("images/service/".$this->banner);
	}

}

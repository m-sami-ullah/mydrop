<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable=["name", "position", "description", "status", "image"];
	const STATUS_SELECT = [ 
				'1' => 'Enable',
				'2' => 'Disable',
			];

	protected $table = "testimonials";

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
		return empty($this->image) ? asset("default/no-image.png"):asset("images/testimonial/".$this->image);
	}

}

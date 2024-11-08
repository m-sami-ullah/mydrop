<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable=["name", "btntitle", "description", "status", "image", "link"];
	const STATUS_RADIO = [ 
				'1' => 'Enable',
				'0' => 'Disable',
			];

	protected $table = "banners";


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
		return empty($this->image) ? asset("default/no-image.png"):asset("images/banner/".$this->image);
	}

}

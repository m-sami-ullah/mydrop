<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable=["name","slug", "description","short_description", "image", "meta_title", "keywords", "meta_description", "robots", "status"];
	const ROBOTS_RADIO = [ 
				'index,nofollow' => 'Index',
				'noindex,follow' => 'Follow',
				'noindex,nofollow' => 'Disallow',
				'index,follow' => 'Allow',
			];

	protected $table = "pages";


    
    
	public function getimage()
	{
		return empty($this->image) ? '':asset("images/page/".$this->image);
	}

}

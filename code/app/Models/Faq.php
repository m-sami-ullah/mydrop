<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable=["question", "answer", "status"];
	
	const STATUS_SELECT = [ 
				'1' => 'Enable',
				'2' => 'Disable',
			];

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
	protected $table = "faqs";


    
    
}

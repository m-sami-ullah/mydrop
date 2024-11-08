<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['icon','link','status'];

    
 

	/**
	 * Query scope Enable.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeEnable($query)
	{
		return $query->where('status',1);
	}

	public function isEnable()
	{
		return $this->status==1?'Enable':'Disable';
	}
}
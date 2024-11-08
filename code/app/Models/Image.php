<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable=["name", 'customer_id','box_id','device_id','status'];
	 
	protected $table = "images";
	 
    /**
     * Image belongs to Customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        // belongsTo(RelatedModel, foreignKey = customer_id, keyOnRelatedModel = id)
        return $this->belongsTo(Customer::class);
    }

    public function url()
    {
        return $this->name ? asset('images/box/'."{$this->customer_id}/{$this->box->id}/{$this->name}"):'';  
    }
    /**
     * Image belongs to Box.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function box()
    {
        // belongsTo(RelatedModel, foreignKey = box_id, keyOnRelatedModel = id)
        return $this->belongsTo(Box::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boxdevice extends Model
{
    protected $fillable=["box_id", "device_id", "status"];
	const STATUS_SELECT = [ 
				1 => 'On',
				2 => 'Off',
				
			];

	protected $table = "boxdevices";


    /**
      * Boxdevice has many Devices through Throughs.
      * Works for 1-1/1-m through 1-1/1-m
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
      */
     // public function devices()
     // {
         // hasManyThrough(FarModel, closeModel, keyOnCloseModel = boxdevice_id, keyOnFarModel = through_id)
         // return $this->hasManyThrough(Device::class, ::class);
     // } 
    
    /**
     *  Boxdevice belongs to Box.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function box()
    {
        // belongsTo(RelatedModel, foreignKey = box_id, keyOnRelatedModel = id)
        return $this->belongsTo(Box::class,'box_id','id');
    }
    /**
     *  Boxdevice belongs to Device.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device()
    {
        // belongsTo(RelatedModel, foreignKey = device_id, keyOnRelatedModel = id)
        return $this->belongsTo(Device::class,'device_id','id');
    }
}

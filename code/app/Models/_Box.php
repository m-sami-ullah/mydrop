<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    
    const STATUS_SELECT = [ 
				'1' => 'Preparing',
				'2' => 'Installed',
			];
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['customer_id','address_id','switch_id','camera_id','status'];
    
    
    /**
     * Order belongs to Customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
    	// belongsTo(RelatedModel, foreignKey = customer_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Customer::class);
    }
    /**
     * Order belongs to Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
    	// belongsTo(RelatedModel, foreignKey = address_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Address::class);
    }/**
     * Order belongs to Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function switch()
    {
        // belongsTo(RelatedModel, foreignKey = switch_id, keyOnRelatedModel = id)
        return $this->belongsTo(Device::class,'switch_id','id');
    }

    /**
     * Box belongs to Camera.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function camera()
    {
        // belongsTo(RelatedModel, foreignKey = camera_id, keyOnRelatedModel = id)
        return $this->belongsTo(Device::class,'camera_id','id');
    }

    
}

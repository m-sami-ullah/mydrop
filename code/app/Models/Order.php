<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_SELECT = [ 
				'1' => 'Processing',
				'2' => 'Completed',
				'3' => 'Cancelled',
			];
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['customer_id','address_id','package_id','package','price','total','tax','payment_type','invoice_number','invoicestatus_id','orderstatus_id'];
    
    public function customername()
    {
        return $this->customer ? $this->customer->fullname() :'';
    }

    public function orderdate()
    {
        return $this->created_at;
    }
    public function complete_address()
    {
        return $this->address_id ? $this->address->fulladdress():'';
    }

    public function order_status()
    {
        return $this->orderstatus_id ? $this->orderstatus->name:'';
    }
    public function invoice_status()
    {
        return $this->invoicestatus_id ? $this->invoicestatus->name:'';
    }

    public function totalpaid()
    {
        return '$'.$this->total;
    }
    /**
     * Order belongs to Orderstatus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderstatus()
    {
        // belongsTo(RelatedModel, foreignKey = orderstatus_id, keyOnRelatedModel = id)
        return $this->belongsTo(Orderstatus::class);
    }
    /**
     * Order belongs to Invoicestatus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoicestatus()
    {
        // belongsTo(RelatedModel, foreignKey = invoicestatus_id, keyOnRelatedModel = id)
        return $this->belongsTo(Invoicestatus::class);
    }
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
    }
    /**
     * Order belongs to Package.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
    	// belongsTo(RelatedModel, foreignKey = package_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Package::class);
    }

    /*public function orderstatus()
    {
    	$status = $this->status ? $this->status : 1;
    	return self::STATUS_SELECT[$status];
    }*/
}

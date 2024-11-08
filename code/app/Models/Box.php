<?php

namespace App\Models;

use App\Models\Device;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable=["boxnumber",'title', "qrcode",'ip', "boxtype", "status", "customer_id", "address_id"];
	const BOXTYPE_SELECT = [ 
				'1' => 'Single Door',
				'2' => 'Two Doors',
				'3' => 'Three Doors',
				'4' => 'Four Doors',
			];
    const STATUS_SELECT = [ 
				1 => 'Bare-metel',
				2 => 'Ready to Install',
                3 => 'Installed',
                4 => 'Returned',
			];

	protected $table = "boxes";


    /**
     * Box has many Images.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = box_id, localKey = id)
        return $this->hasMany(Image::class);
    }
    
    public function camera_endpoint()
    {
        $devices = $this->boxdevices ? $this->boxdevices->pluck('device_id'):[];
        $port = '554';
        if (count($devices)) 
        {
            
            $camera = Device::whereIn('id',$devices)->camera()->first();
            $port = $camera ? $camera->port:'';
        }
        return $this->ip . ':' . $port.'/cgi-bin/snapshot.sh';
    }
    /**
     * Box has many Boxdevices.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boxdevices()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = box_id, localKey = id)
        return $this->hasMany(Boxdevice::class,'box_id','id');
    }
    
    public function switches()
    {
        return $devices = Device::select('devices.*','boxes.ip')->join('boxdevices','boxdevices.device_id','=','devices.id')
        ->join('boxes','boxes.id','=','boxdevices.box_id')
        ->where('devices.boxtype',1)
        ->where('boxes.id',$this->id)
        ->get();
        // ->dd()->toSql();
    }
    /**
     *  Box belongs to Customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        // belongsTo(RelatedModel, foreignKey = customer_id, keyOnRelatedModel = id)
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    /**
     *  Box belongs to Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        // belongsTo(RelatedModel, foreignKey = address_id, keyOnRelatedModel = id)
        return $this->belongsTo(Address::class,'address_id','id');
    }

    public function boxt_type()
    {
        return $this->boxtype ? self::BOXTYPE_SELECT[$this->boxtype] : '';
    }

    public function gettitle()
    {
        return $this->title ? $this->title : 'Main Box';
    }
}

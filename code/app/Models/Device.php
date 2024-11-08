<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable=["name", "deviceid", "boxtype", "model", "port", "installdate", "status", "installed"];
	const STATUS_SELECT = [ 
				1 => 'New',
				2 => 'Installed',
				3 => 'Damage',
			];
	const TYPE_SELECT = [ 
				1 => 'Switch',
				2 => 'Camera',
				3 => 'Door Sensor',
                4 => 'Bare-metal',
			];

	protected $table = "devices";



    public function endpoint()
    {
        switch ($this->boxtype) {
            case 1:
                return '/zeroconf/switch';
                break;
            case 2:
                return '/cgi-bin/snapshot.sh';
                break;
            
            default:
                break;
        }
    }
	/**
	 * Query scope isinstalled.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeNotinstalled($query)
	{
		return $query->where('installed',0);
	}

    /**
     * Query scope switches.
     *
     * @param  \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSwitches($query)
    {
    	return $query->where('boxtype',1);
    }

    /**
     * Query scope camera.
     *
     * @param  \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCamera($query)
    {
    	return $query->where('boxtype',2);
    }

    /**
     * Query scope baremetal.
     *
     * @param  \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBaremetal($query)
    {
        return $query->where('boxtype',4);
    }
    
    /**
     * Query scope sensor.
     *
     * @param  \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSensor($query)
    {
    	return $query->where('boxtype',3);
    }
}

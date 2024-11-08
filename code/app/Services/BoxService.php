<?php

namespace App\Services;

use App\Models\Box;
use App\Models\Boxdevice;
use App\Models\Device;
use App\Services\AppService;
use Illuminate\Http\Request; 
use Exception;
class BoxService extends AppService
{
    protected $model;
    protected $boxtype;


    public function __construct(Box $model)
    {
        parent::__construct($model);
        $this->model = $model;

    }

    /**
     * set payload data for table.
     * 
     * @param Request $request 
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
			$id = $request->box ? $request->box->id : NULL;
			$payload = [
						"boxnumber"=> $request->boxnumber,
						"qrcode"=> $request->qrcode,
						"boxtype"=> $request->boxtype,
						"status"=> $request->status,
						// "customer_id"=> $request->customer_id,
						// "address_id"=> $request->address_id,
			];
			return $payload; 

    }
    
    public function getgallery($box,$request)
    {
        return $box->images()->latest()->get();
    }
     
     public function store_generate($request)
     {
        $number_of_boxes = $request->number_of_boxes;
        $number_of_doors = $request->boxtype;


        if ($number_of_boxes < 1) 
        {
            throw new Exception("Must generate more than one box");
        }

        $this->number_of_doors = $number_of_doors;
        for ($i=0; $i < $number_of_boxes; $i++) 
        { 
            $this->generate_box();
        }
     }
 
    
    public function generate_box()
    {
        $baremetal = $camera     = 1;
        $switches   = $doorsensor = $this->number_of_doors;

        $this->find_devices($switches,$doorsensor,$camera,$baremetal);
        
    }
    
    public function find_devices($switches,$doorsensor,$camera,$baremetal)
    {
        $switchDevices = Device::switches()->notinstalled()->limit($switches)->get();
        if ($switchDevices->count() < $switches) 
        {
            throw new Exception("Switches are out of stock", 1);
        }

        $sensorDevices = Device::sensor()->notinstalled()->limit($doorsensor)->get();
        if ($sensorDevices->count() < $doorsensor) 
        {
            throw new Exception("Door sensors are out of stock", 1);
        }

        $cameraDevices = Device::camera()->notinstalled()->limit($camera)->get();
        if ($cameraDevices->count() < $camera) 
        {
            throw new Exception("Camera are out of stock", 1);
        }

        $metal_Devices = Device::baremetal()->notinstalled()->limit($baremetal)->get();
        if ($metal_Devices->count() < $baremetal) 
        {
            throw new Exception("Bare-metel are out of stock", 1);
        }

            $count = Box::count();
            $count = $count + 1 ;
            $post_number = sprintf('%04d',$count);

            $boxnumber = 'B'.$switches.$doorsensor.$camera . $baremetal.$post_number;
            $box = Box::create(['boxnumber'=>$boxnumber , 'qrcode'=>'','boxtype'=>$this->number_of_doors,'status'=>2]);
            foreach ($switchDevices as $switchDevice) 
            {
                Boxdevice::create(['device_id'=>$switchDevice->id,'box_id'=>$box->id,'status'=>2]); //bydefault off
                $switchDevice->update(['installed'=>1]);
            }

            foreach ($sensorDevices as $sensorDevice) 
            {
                Boxdevice::create(['device_id'=>$sensorDevice->id,'box_id'=>$box->id,'status'=>2]); // by default device off
                $sensorDevice->update(['installed'=>1]);
            }
            foreach ($cameraDevices as $cameraDevice) 
            {
                Boxdevice::create(['device_id'=>$cameraDevice->id,'box_id'=>$box->id,'status'=>2]); // by default device off
                $cameraDevice->update(['installed'=>1]);
            } 

            foreach ($metal_Devices as $metalDevices) 
            {
                Boxdevice::create(['device_id'=>$metalDevices->id,'box_id'=>$box->id,'status'=>2]); // by default device off
                $metalDevices->update(['installed'=>1]);
            } 
        
    } 

    public function update_box($box,$request)
    {
        $payload = [
                        "customer_id"=> $request->customer_id,
                        "address_id"=> $request->address_id,
                        "ip"=> $request->ip,
                        // "switch_id"=> $request->switch_id,
                        // "camera_id"=> $request->camera_id,
                        "status"=> $request->status,
                        "title"=> $request->title,
                    ];
        // dd($payload);
        $box->update($payload);           
    }
    

}

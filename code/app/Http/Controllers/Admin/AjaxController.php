<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use App\Services\AddressService;
use App\Services\AreaService;
use App\Services\CityService;
use DB;
use Exception;
use Illuminate\Http\Request;
class AjaxController extends WebController
{
   protected  $cityservice;
   protected  $areaservice;
protected  $addressservice;

    public function __construct(CityService $cityservice,AreaService $areaservice,AddressService $addressservice)
    {
        $this->cityservice = $cityservice;
        $this->areaservice = $areaservice;
        $this->addressservice = $addressservice;

 
    }

    
     

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cities(Request $request)
    {
        $city_id = $request->id;
        $city = $this->service->all($request);
        $cities      = $this->service->dropdown($city,$city_id);
        return $cities; 
        // return view('admin.cities.index', compact('cities'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function areas(Request $request)
    {
        $area_id = $request->area_id;
        $city = $this->areaservice->all($request);
        $areas      = $this->areaservice->dropdown($city,$area_id);
        return $areas; 
        // return view('admin.cities.index', compact('cities'));
    }
    /** * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function addresses(Request $request)
    {
        $address_id = $request->id;
        $address = $this->addressservice->all($request);
        // dd($address);
        $addresses      = $this->addressservice->dropdown($address,$address_id,['id','title']);
        return $addresses;
    }

}

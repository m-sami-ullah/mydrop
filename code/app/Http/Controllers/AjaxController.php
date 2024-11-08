<?php

namespace App\Http\Controllers;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Services\CityService;
use App\Services\StateService;
use App\Services\AreaService;
use Exception;
use DB;
class AjaxController extends WebController
{
    protected  $service;
    protected  $areaservice;
    public function __construct(CityService $service,AreaService $areaservice)
    {
        $this->service = $service;
        $this->areaservice = $areaservice;
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

    
}

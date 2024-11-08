<?php

namespace App\Http\Controllers;
use App\Http\Controllers\WebController;
use App\Models\Package;
use App\Services\PackageService;
use Exception;
use Illuminate\Http\Request;

class PackageController extends WebController
{
    protected  $service;
    public function __construct(PackageService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Package $plan)
    {
        return view('checkout',compact('plan'));
    }

    
    

}

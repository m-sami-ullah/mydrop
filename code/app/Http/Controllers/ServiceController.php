<?php

namespace App\Http\Controllers;
use App\Http\Controllers\WebController;
use App\Models\Service;
use App\Services\ServiceService;
use Auth;
use DB;
use Exception;
use Illuminate\Http\Request;

class ServiceController extends WebController
{
    protected  $service;
    public function __construct(ServiceService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Service $service)
    {
        return view('service',compact('service'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactus(Request $request)
    {
        $page = $this->service->bySlug('contact-us');

        return view('page.contactus',compact('page'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savecontact(ContactusRequest $request)
    {

         // $message = $request->message;
        
        
        /*        $rules = [
            'name'=>'required|max:150',
            'email'=>'required|email|max:200',
            'subject'=>'required|max:200',
            'message'=>'required',
        ];
        */
        /*if(count(explode(' ', $message)) < 50)
        {
            $rules['message'] = 'required|minwords'
            $message['message.minwords'] = 'Atlease 50 words are required'
        }*/
        // $this->validate($request, $rules,[],$message);

        // $this->validate($request, $rules);

        try {
            DB::beginTransaction();
            $this->service->savecontact($request);
            $this->success($this->service->Msg('your_inquiry_has_been_received'));
            DB::commit();
            return redirect()->back();
        }catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->all())->with(['error' => __('lang.something_goes_wrong')]);
        }
    }


}

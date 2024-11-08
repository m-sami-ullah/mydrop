<?php

namespace App\Http\Controllers;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\ContactusRequest;

use App\Models\Page;
use App\Models\Faq;
use App\Services\PageService;
use Exception;
use DB;
use Auth;

class PageController extends WebController
{
    protected  $service;
    public function __construct(PageService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page(Page $page)
    {

        // $page = $this->service->bySlug($slug);
        
        return view('page',compact('page'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactus(Request $request)
    {
        // $page = $this->service->bySlug('contact-us');
        // return view('page.contactus',compact('page'));

        return view('contactus');
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
            $this->success('Your message send successfully');
            DB::commit();
            return redirect()->back();
        }catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->all())->with(['error' => __('lang.something_goes_wrong')]);
        }
    }


    public function thanks()
    {
        return view('thanks');
    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\TestimonialRequest;
use Illuminate\Support\Facades\App;
use App\Models\Testimonial;

use App\Services\TestimonialService;

use Exception;
use DB;
class TestimonialController extends WebController
{
    protected  $testimonialservice;


    public function __construct(TestimonialService $testimonialservice)
    {
        $this->testimonialservice = $testimonialservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Testimonial::class);
        
        $testimonials = $this->testimonialservice->paginate($request);
        
        return view('admin.testimonials.index',['testimonials' => $testimonials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Testimonial::class);
        
                $conststatusoptions = $this->testimonialservice->getconst("STATUS_SELECT");
        $conststatusoptions = $this->testimonialservice->dropdown($conststatusoptions,old('status'),[],false);

        return view('admin.testimonials.create',['conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialRequest $request)
    {
        $this->authorize('create',Testimonial::class);
        try {
            DB::beginTransaction();
            $record = $this->testimonialservice->store($request);
            $this->success($this->testimonialservice->addMsg());
            DB::commit();
            return redirect()->route('testimonials.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Testimonial $testimonial)
    {
        $this->authorize('update', $testimonial);
        
                $conststatusoptions = $this->testimonialservice->getconst("STATUS_SELECT");
        $conststatusoptions = $this->testimonialservice->dropdown($conststatusoptions,$testimonial->status,[],false);

        return view('admin.testimonials.edit',['testimonial' => $testimonial,'conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $this->authorize('create',Testimonial::class);
        try {
            DB::beginTransaction();
            $record = $this->testimonialservice->update($testimonial,$request);
            $this->success($this->testimonialservice->updateMsg());
            DB::commit();
            return redirect()->route('testimonials.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {   
        $this->authorize('delete',Testimonial::class);  
        try {
            DB::beginTransaction();
            $this->testimonialservice->delete($testimonial);
            $this->success($this->testimonialservice->delMsg());
            DB::commit();
            return redirect()->route('testimonials.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Testimonial::class);
        try {
            DB::beginTransaction();
            $this->testimonialservice->deleteall($request);
            $this->success($this->testimonialservice->delMsg());
            DB::commit();
            return redirect()->route('testimonials.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->testimonialservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}

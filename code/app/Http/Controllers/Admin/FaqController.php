<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\FaqRequest;
use Illuminate\Support\Facades\App;
use App\Models\Faq;

use App\Services\FaqService;

use Exception;
use DB;
class FaqController extends WebController
{
    protected  $faqservice;


    public function __construct(FaqService $faqservice)
    {
        $this->faqservice = $faqservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Faq::class);
        
        $faqs = $this->faqservice->paginate($request);
        
        return view('admin.faqs.index',['faqs' => $faqs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Faq::class);
        
        		$conststatusoptions = $this->faqservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->faqservice->dropdown($conststatusoptions,old('status'));

        return view('admin.faqs.create',['conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $this->authorize('create',Faq::class);
        try {
            DB::beginTransaction();
            $record = $this->faqservice->store($request);
            $this->success($this->faqservice->addMsg());
            DB::commit();
            return redirect()->route('faqs.index');
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
    public function show(Faq $faq)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Faq $faq)
    {
        $this->authorize('update', $faq);
        
        		$conststatusoptions = $this->faqservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->faqservice->dropdown($conststatusoptions,$faq->status);

        return view('admin.faqs.edit',['faq' => $faq,'conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $this->authorize('create',Faq::class);
        try {
            DB::beginTransaction();
            $record = $this->faqservice->update($faq,$request);
            $this->success($this->faqservice->updateMsg());
            DB::commit();
            return redirect()->route('faqs.index');
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
    public function destroy(Faq $faq)
    {   
        $this->authorize('delete',Faq::class);  
        try {
            DB::beginTransaction();
            $this->faqservice->delete($faq);
            $this->success($this->faqservice->delMsg());
            DB::commit();
            return redirect()->route('faqs.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Faq::class);
        try {
            DB::beginTransaction();
            $this->faqservice->deleteall($request);
            $this->success($this->faqservice->delMsg());
            DB::commit();
            return redirect()->route('faqs.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->faqservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}

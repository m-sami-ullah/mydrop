<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\App;
use App\Models\Customer;

use App\Services\CustomerService;

use Exception;
use DB;
class CustomerController extends WebController
{
    protected  $customerservice;


    public function __construct(CustomerService $customerservice)
    {
        $this->customerservice = $customerservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Customer::class);
        
        $customers = $this->customerservice->paginate($request);
        
        return view('admin.customers.index',['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Customer::class);
        
        		$conststatusoptions = $this->customerservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->customerservice->dropdown($conststatusoptions,old('status'));
		$constsignupoptions = $this->customerservice->getconst("SIGNUP_SELECT");
		$constsignupoptions = $this->customerservice->dropdown($constsignupoptions,old('signup'));

        return view('admin.customers.create',['conststatusoptions' => $conststatusoptions,'constsignupoptions' => $constsignupoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $this->authorize('create',Customer::class);
        try {
            DB::beginTransaction();
            $record = $this->customerservice->store($request);
            $this->success($this->customerservice->addMsg());
            DB::commit();
            return redirect()->route('customers.index');
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
    public function show(Customer $customer)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Customer $customer)
    {
        $this->authorize('update', $customer);
        
        		$conststatusoptions = $this->customerservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->customerservice->dropdown($conststatusoptions,$customer->status);
		$constsignupoptions = $this->customerservice->getconst("SIGNUP_SELECT");
		$constsignupoptions = $this->customerservice->dropdown($constsignupoptions,$customer->signup);

        return view('admin.customers.edit',['customer' => $customer,'conststatusoptions' => $conststatusoptions,'constsignupoptions' => $constsignupoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('create',Customer::class);
        try {
            DB::beginTransaction();
            $record = $this->customerservice->update($customer,$request);
            $this->success($this->customerservice->updateMsg());
            DB::commit();
            return redirect()->route('customers.index');
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
    public function destroy(Customer $customer)
    {   
        $this->authorize('delete',Customer::class);  
        try {
            DB::beginTransaction();
            $this->customerservice->delete($customer);
            $this->success($this->customerservice->delMsg());
            DB::commit();
            return redirect()->route('customers.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Customer::class);
        try {
            DB::beginTransaction();
            $this->customerservice->deleteall($request);
            $this->success($this->customerservice->delMsg());
            DB::commit();
            return redirect()->route('customers.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->customerservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}

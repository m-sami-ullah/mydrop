<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\OrderService;

use Exception;
use DB;
class OrderController extends WebController
{
    protected  $orderservice;


    public function __construct(OrderService $orderservice)
    {
        $this->orderservice = $orderservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Order::class);
        
        $orders = $this->orderservice->paginate($request);
        
        return view('admin.orders.index',['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Order::class);
        
        		$conststatusoptions = $this->orderservice->getconst("STATUS_RADIO");
		$conststatusoptions = $this->orderservice->dropdown($conststatusoptions,old('status'));

        return view('admin.orders.create',['conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $this->authorize('create',Order::class);
        try {
            DB::beginTransaction();
            $record = $this->orderservice->store($request);
            $this->success($this->orderservice->addMsg());
            DB::commit();
            return redirect()->route('orders.index');
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
    public function show(Order $order)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Order $order)
    {
        $this->authorize('update', $order);
        
        		// $conststatusoptions = $this->orderservice->getconst("STATUS_RADIO");
		// $conststatusoptions = $this->orderservice->dropdown($conststatusoptions,$order->status);

        return view('admin.orders.edit',['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, Order $order)
    {
        $this->authorize('create',Order::class);
        try {
            DB::beginTransaction();
            $record = $this->orderservice->update($banner,$request);
            $this->success($this->orderservice->updateMsg());
            DB::commit();
            return redirect()->route('orders.index');
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
    public function destroy(Order $order)
    {   
        $this->authorize('delete',Order::class);  
        try {
            DB::beginTransaction();
            $this->orderservice->delete($banner);
            $this->success($this->orderservice->delMsg());
            DB::commit();
            return redirect()->route('orders.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Order::class);
        try {
            DB::beginTransaction();
            $this->orderservice->deleteall($request);
            $this->success($this->orderservice->delMsg());
            DB::commit();
            return redirect()->route('orders.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->orderservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}

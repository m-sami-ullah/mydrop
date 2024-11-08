<?php

namespace App\Traits;
trait WebResponser{

    protected function success($message = null)
	{
		session()->flash('message', $message);
	}
	protected function warning($message = null)
	{
		session()->flash('warning', $message);
	}

	protected function error($message = null)
	{
		session()->flash('error', $message);
		return redirect()->back()->withInput(request()->all())->with(['error' => $message]);
	}


	 protected function apisuccess($data, $message = null, $code = 200)
	{
		return response()->json([
			'status'=> 'Success', 
			'message' => $message, 
			'data' => $data
		], $code);
	}

	protected function apierror($message = null, $code=422)
	{
		return response()->json([
			'status'=>'Error',
			'message' => $message,
			'data' => null
		], $code);
	}
}
<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
 
trait ApiResponser{

    protected function success($data, $message = null, $code = 200)
	{
		return response()->json([
			'status'=> 'Success', 
			'message' => $message, 
			'data' => $data
		], $code);
	}

	protected function error($message = null, $code=422)
	{
		return response()->json([
			'status'=>'Error',
			'message' => $message,
			'data' => null
		], $code);
	}

	protected function log($message = null)
	{
		Log::info($message);
	}



}
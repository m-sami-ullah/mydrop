<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoxdeviceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->boxdevice ? $this->boxdevice->id : NULL;
        
        $rules = [
				"device_id"=>"required",
				"status"=>"required",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"device_id"=>"Device",
				"status"=>"Status",
				];
		return $attributes; 

        
    }
}

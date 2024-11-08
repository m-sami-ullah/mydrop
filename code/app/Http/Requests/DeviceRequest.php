<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
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
        $id = $this->device ? $this->device->id : NULL;
        
        $rules = [
				"name"=>"required",
				"deviceid"=>"required|unique:devices,id," . $id,
				// "port"=>"required",
				// "model"=>"required",
                "type"=>"required",

				// "install"=>"nullable|date_format:Y-m-d",
				// "channels"=>"nullable",
				// "status"=>"required",
				// "installed"=>"nullable",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"name"=>"Name",
				"deviceid"=>"FCC ID",
				"model"=>"Device Model",
                "type"=>"Device Type",
				"port"=>"Device Port",
				// "install"=>"Installation Date",
				// "channels"=>"Channenls",
				// "status"=>"Status",
				// "installed"=>"Installed",
				];
		return $attributes; 

        
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoxRequest extends FormRequest
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
        $id = $this->box ? $this->box->id : NULL;
        
        $rules = [
				"boxnumber"=>"required",
				"qrcode"=>"nullable",
				"boxtype"=>"required",
				"status"=>"required",
				// "customer_id"=>"required",
				// "address_id"=>"required",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"boxnumber"=>"Box Number",
				"qrcode"=>"QR Code",
				"boxtype"=>"Number of Doors",
				"status"=>"Status",
				"customer_id"=>"Customer",
				"address_id"=>"Address",
				];
		return $attributes; 

        
    }
}

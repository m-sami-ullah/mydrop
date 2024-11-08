<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
        $id = $this->address ? $this->address->id : NULL;
        
        $rules = [
				"title"=>"required",
				"state_id"=>"required",
				"city_id"=>"required",
				"area_id"=>"required",
				"postcode"=>"nullable",
				"streetaddress"=>"nullable",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"title"=>"Title",
				"state_id"=>"State",
				"city_id"=>"City",
				"area_id"=>"Area",
				"postcode"=>"Post Code",
				"address"=>"Address",
				];
		return $attributes; 

        
    }
}

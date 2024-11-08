<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
        $id = $this->country ? $this->country->id : NULL;
        
        $rules = [
				"name"=>"required",
				"iso"=>"required",
				"nicename"=>"required",
				"iso3"=>"nullable",
				"numcode"=>"nullable",
				"phonecode"=>"required",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"name"=>"Name",
				"iso"=>"ISO",
				"nicename"=>"Nick Name",
				"iso3"=>"ISO 3 Character Code",
				"numcode"=>"Number Code",
				"phonecode"=>"Phone Code",
				];
		return $attributes; 

        
    }
}

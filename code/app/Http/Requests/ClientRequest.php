<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        $id = $this->client ? $this->client->id : NULL;
        
        $rules = [
				"name"=>"required",
				// "logo"=>"required|mimes:jpg,png,jpeg",
				];

        if (!$id) 
        {
            $rules["logo"] =  "required|mimes:png,jpeg,jpg";
        }
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"name"=>"Title",
				"logo"=>"Logo",
				];
		return $attributes; 

        
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $id = $this->customer ? $this->customer->id : NULL;
        
        $rules = [
				"firstname"=>"required",
				"lastname"=>"required",
				"email"=>"required|email|unique:customers,id," . $id,
				"phone"=>"nullable",
				"status"=>"nullable",
				"lastlogin"=>"nullable|date_format:h:m:s",
				"ip"=>"nullable",
				"signup"=>"nullable",
				];
			if (!$id) 
			{ 
				$rules["password"] = "required";			
			} 
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"firstname"=>"First Name",
				"lastname"=>"Last Name",
				"email"=>"Email",
				"password"=>"Password",
				"phone"=>"Phone Number",
				"status"=>"Status",
				"lastlogin"=>"Last login",
				"ip"=>"Login IP",
				"signup"=>"Registration",
				];
		return $attributes; 

        
    }
}

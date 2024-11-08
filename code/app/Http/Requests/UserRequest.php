<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->user ? $this->user->id : NULL;
        
        $rules = [
				"name"=>"required",
				"email"=>"required|email",
				"activated"=>"required",
				"group_id"=>"required",
				];
			if (!$id) 
			{ 
			$rules["password"] = "required";			} 
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"name"=>"Full Name",
				"email"=>"Email Address",
				"password"=>"Password",
				"activated"=>"Status",
				"group_id"=>"Group",
				];
		return $attributes; 

        
    }
}

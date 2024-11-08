<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderstatusRequest extends FormRequest
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
        $id = $this->orderstatus ? $this->orderstatus->id : NULL;
        
        $rules = [
				"name"=>"required",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"name"=>"Status",
				];
		return $attributes; 

        
    }
}

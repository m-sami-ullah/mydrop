<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
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
        $id = $this->state ? $this->state->id : NULL;
        
        $rules = [
				"name"=>"nullable",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"name"=>"Name",
				];
		return $attributes; 

        
    }
}

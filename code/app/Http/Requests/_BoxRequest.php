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
				"switch_id"=>"required",
				"camera_id"=>"required",
                "status"=>"required",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"switch_id"=>"Switch",
				"camera_id"=>"Camera",
                "status"=>"Status",
				];
		return $attributes; 

        
    }
}

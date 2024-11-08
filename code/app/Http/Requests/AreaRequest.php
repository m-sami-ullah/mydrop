<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
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
        $id = $this->area ? $this->area->id : NULL;
        
        $rules = [
				"name"=>"nullable",
				"city_id"=>"nullable",
				"state_id"=>"nullable",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"name"=>"Name",
				"city_id"=>"City",
				"state_id"=>"State",
				];
		return $attributes; 

        
    }
}

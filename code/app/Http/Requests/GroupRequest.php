<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
        $id = $this->group ? $this->group->id : NULL;
        
        $rules = [
				"name"=>"required",
				"status"=>"required",
				"permission_id"=>"required",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"name"=>"Name",
				"status"=>"Status",
				"permission_id"=>"Permission",
				];
		return $attributes; 

        
    }
}

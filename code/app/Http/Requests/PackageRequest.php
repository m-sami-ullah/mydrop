<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
        $id = $this->package ? $this->package->id : NULL;
        
        $rules = [
				"name"=>"required",
                "slug"=>"required|unique:packages,slug," . $id,
				"description"=>"nullable",
				"price"=>"required",
				"duration"=>"required",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"name"=>"Package Name",
				"description"=>"Description",
				"price"=>"Price",
				"duration"=>"Duration",
				];
		return $attributes; 

        
    }
}

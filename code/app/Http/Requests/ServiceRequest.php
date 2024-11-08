<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        $id = $this->service ? $this->service->id : NULL;
        
        $rules = [
				"title"=>"required",
				"short"=>"required",
				"description"=>"required",
				"slug"=>"required|unique:services,slug," . $id,
				// "image"=>"required|mimes:jpg,png,jpeg",
				"status"=>"nullable",
				];
        if (!$id) 
        {
            $rules["image"] =  "required|mimes:png,jpeg,jpg";
            $rules["banner"] =  "required|mimes:png,jpeg,jpg";
        }
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"title"=>"Title",
				"short"=>"Short Description",
				"description"=>"Description",
				"slug"=>"Slug",
				"image"=>"Image",
                "banner"=>"Banner",
				"status"=>"Status",
				];
		return $attributes; 

        
    }
}

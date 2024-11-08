<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
        $id = $this->page ? $this->page->id : NULL;
        
        $rules = [
				"name"=>"required",
                "slug"=>"required|unique:pages,slug," . $id,
				"description"=>"required",
                "short_description"=>"required",
				// "image"=>"nullable|mimes:png,jpg,jpeg,bmp",
				"meta_title"=>"nullable",
				"keywords"=>"nullable",
				"meta_description"=>"nullable",
				"robots"=>"nullable",
				"status"=>"nullable",
				];
        if (!$id) 
        {
            $rules["image"] =  "required|mimes:png,jpeg,jpg";
        }
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"name"=>"Title",
				"description"=>"Description",
				"image"=>"Banner",
				"meta_title"=>"Meta title",
				"keywords"=>"Keywords",
				"meta_description"=>"Meta Description",
				"robots"=>"Robots",
				"status"=>"Status",
				];
		return $attributes; 

        
    }
}

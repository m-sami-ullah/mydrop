<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
        $id = $this->testimonial ? $this->testimonial->id : NULL;
        
        $rules = [
                "name"=>"required",
                "position"=>"required",
                "description"=>"required",
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
                "name"=>"Full Name",
                "position"=>"Position",
                "description"=>"Testimonials",
                "status"=>"Status",
                "image"=>"Image",
                ];
        return $attributes; 

        
    }
}

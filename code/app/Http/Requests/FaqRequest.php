<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
        $id = $this->faq ? $this->faq->id : NULL;
        
        $rules = [
				"question"=>"required",
				"answer"=>"required",
				"status"=>"nullable",
				];
			return $rules; 

        
    }
    
    public function attributes()
    {
         
        $attributes = [
				"question"=>"Question",
				"answer"=>"Answer",
				"status"=>"Status",
				];
		return $attributes; 

        
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helper\Validate;

class SiteconfigRequest extends FormRequest
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
        $fields = [
                // 'name'=>'required',
                // 'description'=>'required',
                'disclaimer'=>'required',
            ];
        $rule =  Validate::generate($fields); 
        $rule['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        $rule['favicon'] = 'mimes:ico,png|max:200';
        $rule['email'] = 'required';
        $rule['phone'] = 'required';

        return $rule;
    }

    public function attributes()
    {
        $attribute = [
                  // 'name' => 'Title',
                      // 'description'=> 'Description',
                      'disclaimer'=> 'Site Disclaimer',
                    ];
        $attributes =  Validate::attributes($attribute); 
        $attributes['image'] = 'Logo'; 
        $attributes['favicon'] = 'Favicon'; 
        $attributes['notify'] = 'Email'; 
        $attributes['phone'] = 'Phone'; 
        
        return $attributes;
    }
}

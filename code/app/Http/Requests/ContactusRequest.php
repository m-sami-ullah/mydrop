<?php

namespace App\Http\Requests;

use App\Helper\Validate;
use App\Rules\ReCaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactusRequest extends FormRequest
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
        return [
              'firstname' => 'required|max:150',
              'lastname' => 'required|max:150',
              'email' => 'required|email|max:255',
              // 'subject' => 'required|max:200',
              'message' => 'required',
              'recaptcha_token' => ['required', new   ReCaptchaRule($this->recaptcha_token)]
        ];
    }

    public function attributes()
    {
        return [
              'firstname' => 'First Name'  ,
              'lastname' => 'Last Name'  ,
              'email' => 'Email Address' , 
              // 'subject' => 'Subject',
              'message' => 'Message',
        ];
    }

    public function messages()
    {
        return [
       'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
       'g-recaptcha-response.required' => 'Please complete the captcha'
       ];
    }
}

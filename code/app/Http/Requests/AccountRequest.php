<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class AccountRequest extends FormRequest
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
      $id = Auth::guard('customer')->user()->id;
        
      $validation_data = [
              'firstname' => 'required',
              'lastname' => 'required',
        ];
        // if (empty(Auth::guard('customer')->user()->phone_verified_at)) 
        {
            $validation_data['phone'] = 'required|unique:customers,phone,'.$id;
        }
        // if (empty(Auth::guard('customer')->user()->email_verified_at))
        {
            $validation_data['email'] = 'required|unique:customers,email,'.$id;
        }
    
        // dd($validation_data);
        return $validation_data;


       
    }

    public function attributes()
    {
        return [
              'firstname' => 'First Name'  ,
              'lastname' => 'Last Name'  ,
              'email' => 'Email Address' ,
              'phone' => 'Phone Number' ,
        ];
    }
    /*public function rules()
    {
        return [
              'full_name' => 'required',
              'state' => 'required|exists:states,id',
              'city' => 'required|exists:cities,id',
              'area' => 'required|exists:areas,id',
        ];
    }

    public function attributes()
    {
        return [
              'full_name' => __('lang.name')  ,
              'state' => __('lang.state') , 
              'city' => __('lang.city')  ,
              'area' => __('lang.area')  ,
        ];
    }*/
}

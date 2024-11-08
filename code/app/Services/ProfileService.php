<?php

namespace App\Services;

use App\Models\Customer; 
use App\Services\AppService;
use Illuminate\Http\Request; 
use Auth;
use Illuminate\Support\Facades\Hash;
class ProfileService extends AppService
{
    protected $model;

    public function __construct(Customer $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    public function save_account(Request $request,$guard='customer')
    {

        $phone = $request->has('phone') ? $request->phone :NULL;

        $data = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            
           /*
            'state_id' => $request->state,
            'city_id' => $request->city,
            'area_id' => $request->area,
            'address' => $request->address,
            'showphone' => $showphone,*/
            ];

        if ($guard=='customer') 
        {
            
            // if (empty(Auth::guard('customer')->user()->phone_verified_at)) 
            {
                $data['phone'] = $phone;
            } 
            // if (empty(Auth::guard('customer')->user()->email_verified_at))
            {
                $data['email'] = $request->email;
            }
        }else{

             $data['phone'] = $phone;
        }


        $id = Auth::guard($guard)->user()->id;
        
        $this->model->where('id',$id)->update($data);

        
        return  $this->model->findOrFail($id);
    }

    public function edit($subcategory,$request)
    {
        $this->update($subcategory,$request);
        // $this->manytomany($subcategory,'attributes',$request->attribute,['required'=>0]);
    }
    
    public function update_password($request,$guard='customer')
    {

        $customer = Auth::guard($guard)->user();

        $current_password = $request->current_password;
        if (!Hash::check($current_password, $customer->password)) 
        {
            throw new \Exception(__('lang.password_does_not_match'), 1);
            
        }
        
        $password = $request->password;
        $customer->update(['password'=>Hash::make($password)]);
    }
 

    public function all(Request $request)
    {
        $fillable = $this->model->getFillable();
        $filters = $request->only($fillable);


        if (count($filters)!=0) 
        {
             return $this->model
                                ->where($filters)
                
                                // ->orWhere($orWhere)
                                ->get();
                                
            // if ($request->has('pagination') && $request->pagination=='no') 
            // {

            //     // if ($request->has('q')) 
            //     // {
            //     //     $orWhere         = array_fill_keys($fillable, $request->q);
            //     // }

               
            // }else{
            //     return $this->model->paginate($request->input('limit', $this->limit));
            // }

        }else
        {
            return $this->model->get();
        }
    }

}

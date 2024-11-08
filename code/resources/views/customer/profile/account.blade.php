@extends('customer.profile.profile_master')

 
@section('profile_header_title','Account Details')
@section('profile_bread_crumb')
<li>Account Details</li>
@endsection

@section('profile_content')
   <form    method="post" action="{{ route('customer.account.update') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="post-section basic-information">
                        <div class="post-ad-title">
                            <i class="fas fa-user"></i>
                            <h3 class="item-title">Basic Information</h3>
                        </div>


                            <div class="form-floating mb-4">
                              <input  name="email" type="email" value="{{ Auth::guard('customer')->user()->email }}" class="form-control" placeholder="Email address">
                              <label for="textInputExample">Email address</label>
                            </div>

                            <div class="form-floating mb-4">
                              <input  required="required"  value="{{ Auth::guard('customer')->user()->firstname }}"  name="firstname" class="form-control" placeholder="First Name">
                              <label for="textInputExample">First Name</label>
                                @if($errors->has('firstname'))
                                    <small class="form-text text-danger">{{ $errors->first('firstname') }}</small> 
                                @endif 
                            </div>

                            <div class="form-floating mb-4">
                              <input  required="required"  value="{{ Auth::guard('customer')->user()->lastname }}" class="form-control" name="lastname" class="form-control" placeholder="Last Name">
                              <label for="textInputExample">Last Name</label>
                               @if($errors->has('lastname'))
                                    <small class="form-text text-danger">{{ $errors->first('lastname') }}</small> 
                                @endif 
                            </div>
                            
                            <div class="form-floating mb-4">
                              <input  required="required"  value="{{ Auth::guard('customer')->user()->phone }}" class="form-control" name="phone" class="form-control" placeholder="Phone Number">
                              <label for="textInputExample">Phone Number</label>
                               @if($errors->has('phone'))
                                    <small class="form-text text-danger">{{ $errors->first('phone') }}</small> 
                                @endif 
                            </div>
                     

                          
                         
                         <div class="form-floating mb-4">
                                
                                    <input type="submit" class="btn btn-primary" value="Update">
                                 
                           
                        </div>
                         
                    </div>
                     
                </form>
@endsection('content')

@section('web_footer_scripts')

@parent


@endsection






@extends('customer.profile.profile_master')

 
@section('profile_header_title',trans('lang.change_password'))
@section('profile_bread_crumb')
<li>{{ trans('lang.change_password') }}</li>
@endsection

@section('profile_content')
 
                <form    method="post" action="{{ route('customer.password.update') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="post-section basic-information">
                        <div class="post-ad-title">
                            <i class="fas fa-key"></i>
                            <h3 class="item-title">Change Password</h3>
                        </div>
                        <div class="row  mt-3">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Current Password
                                    <span>*</span>

                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group {{ $errors->has('current_password')?'has-error':'' }}">
                                    <input type="password" value="" class="form-control" name="current_password" id="current_password">
                                    @if($errors->has('current_password'))
                                        <p class="text-danger">{{ $errors->first('current_password') }}</p> 
                                    @endif 
                                </div>
                            </div>
                        </div>
                        <div class="row  mt-3">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    New Password
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group {{ $errors->has('password')?'has-error':'' }}">
                                    <input type="password" value="" class="form-control" name="password" id="">
                                    @if($errors->has('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p> 
                                    @endif 
                                </div>
                            </div>
                        </div>
                         
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Confirm Password
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group {{ $errors->has('password_confirmation')?'has-error':'' }}">

                                    <input type="password" value="" class="form-control" name="password_confirmation" id="password_confirmation">
                                    @if($errors->has('password_confirmation'))
                                        <p class="text-danger">{{ $errors->first('password_confirmation') }}</p> 
                                    @endif 
                                </div>
                                </div>
                            </div>
                        </div>
                        
                        
                         
                    <div class="post-section location-detail mt-3">
                           
                        <div class="row">
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Change Password">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
             
@endsection()
 






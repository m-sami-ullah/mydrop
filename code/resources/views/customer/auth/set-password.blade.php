@extends('layout.oui_master')

@section('content')
 
<section id="login-section" class="my-3 py-5">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h5>{{ trans('lang.set_password') }}</h5>
                <p>{{ trans('lang.please_set_your_password') }}</p>
            </div>
        </div>
         
        <div class="row">
            <div class="col-sm-6 offset-sm-3 col-md-4 offset-md-4">
                <form class="form" action="{{ route('seller.auth.setemailpassword') }}" method="post">
                    {{ csrf_field() }}

                    <input type="hidden" name="email" value="{{ old('email',$email) }}">
                    <input type="hidden" name="code" value="{{ old('code',$code) }}">
                    
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-12 control-label">{{ trans('lang.password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-12 control-label">{{ trans('lang.confirm_password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                     @if (session('message'))
                        <span class="help-block">
                            <strong>{{ session('message') }}</strong>
                        </span>
                    @endif 
                    <div class="form-group text-center">
                        <button class="btn btn-dark">{{ trans('lang.set_password') }}</button>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
</section> 
@endsection('content')
 



@extends('layout.oui_master')

@section('content')

<section id="login-section" class="my-3 py-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 border  d-flex align-items-center" style="border: 3px dashed #6c757d30 !important;">
            
                <form class="form w-100" action="{{ route('seller.auth.postemailpassword') }}" method="post">
                    <div class="text-center">
                        <h3 class="font-weight-bold">{{ trans('lang.enter_your_password') }}</h3>
                        <h5>{{ trans('lang.welcome_back') }} <b>{{ $email }}</b></h5>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="password" class="form-control " value="{{ old('password') }}" name="password" placeholder="@lang('Password')">
                        @if ($errors->has('email'))
                            <span class="form-text text-danger ">
                                <strong><small>{{ $errors->first('email') }}</small></strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="form-group text-center">
                        <button class="btn btn-dark">{{ trans('lang.login') }}</button>
                    </div>
                    <div class="text-center d-none">
                    <a href="#">{{ trans('lang.forgot_your_password') }}?</a>
                    </div>
                </form>
            </div>
            <div class="col-sm-1 d-flex align-items-center">
                <h1 class="font-weight-bold" style="font-weight: 900;font-family: 'Roboto';">{{ trans('lang.or') }}</h1>
            </div>
            <div class="col-sm-6">
                <div class="login-options w-100 mt-3 mt-md-0">
                <a href="{{ route('seller.auth.phone') }}" class="btn btn-block btn-secondary"><i class="fas fa-mobile-alt mr-2"></i> {{ trans('lang.login_phone') }}</a>
                <a href="{{ route('loginwithfacebook') }}" class="btn btn-block btn-primary"><i class="fab fa-facebook mr-2"></i> {{ trans('lang.login_facebook') }}</a>
                <a href="{{ route('loginwithgoogle') }}" class="btn btn-block btn-secondary"><i class="fab fa-google mr-2"></i> {{ trans('lang.login_google') }}</a>
                <a href="{{ route('seller.auth.email') }}" class="btn btn-block btn-primary"><i class="far fa-envelope mr-2"></i> {{ trans('lang.login_email') }}</a>
                    <div class="terms--conditions mt-3 pb-3 pb-md-0">
                        <p class="font-weight-bold" style="line-height:1;"><small>{{ trans('lang.we_wont_share_personal_details') }}</small></p>
                        <p class="m-0 font-weight-bold" style="line-height:1;"><small>{{ trans('lang.if_continue_you_are_accepting') }} <a href="#">{{ trans('lang.terms_and_conditions') }}</a> {{ trans('lang.and') }} <a href="#">{{ trans('lang.privacy_policy') }}</a></small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
@endsection('content')








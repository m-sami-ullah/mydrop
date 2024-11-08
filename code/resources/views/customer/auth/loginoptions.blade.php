@extends('layout.web_master')

@section('content')

<section id="login-section" class="my-4">
    <div class="container">
        <div class="row">
            <div class="offset-sm-1 col-sm-7 offset-md-1 col-md-7 pr-md-0 mb-3 mb-md-0">
                <img src="{{ asset('default/uoi-login-banner.jpg') }}"/>
            </div>
            <div class="col-sm-3 col-md-3 bg-light d-flex align-items-center border">
                <div class="login-options w-100 mt-3 mt-md-0">
                <a href="{{ route('customer.auth.phone') }}" class="btn btn-block btn-secondary"><i class="fas fa-mobile-alt mr-2"></i> {{ trans('lang.login_phone') }}</a>
                <a href="{{ route('loginwithfacebook') }}" class="btn btn-block btn-primary"><i class="fab fa-facebook mr-2"></i> {{ trans('lang.login_facebook') }}</a>
                <a href="{{ route('loginwithgoogle') }}" class="btn btn-block btn-secondary"><i class="fab fa-google mr-2"></i> {{ trans('lang.login_google') }}</a>
                <a href="{{ route('customer.auth.email') }}" class="btn btn-block btn-primary"><i class="far fa-envelope mr-2"></i> {{ trans('lang.login_email') }}</a>
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








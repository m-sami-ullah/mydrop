@extends('layouts.login_master')

@section('main')


<div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo">
                        <img src="{{ URL::asset('default/logo.png') }}" width="130px" alt=""/>
                    </h2>
                </div>

                <form class="sign-in-form" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                     <input type='hidden' name='recaptcha_token' id='recaptcha_token'>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" name="email" class="form-control" placeholder="User name" required="">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    @if($errors->has('recaptcha_token'))
                            {{$errors->first('recaptcha_token')}}
                        @endif
                     
                    <button type="submit" class="btn btn-info btn-block">Login</button>
                    <?php /*<div class="text-center help-block">
                        <a href="{{ route('password.request') }}"><small>Forgot password?</small></a>
                    </div>*/ ?>
                </form>
                <div class="text-center copyright-txt">
                    <small> Powered by <a target="_blank" href="https://thewx3.com">Wx3</a></small>
                </div>
            </div>
        </div>

 
@endsection('main')

@section('web_footer_scripts')

<script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}"></script>
<script>
grecaptcha.ready(function() {
  grecaptcha.execute('{{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}')    .then(function(token) {
   document.getElementById("recaptcha_token").value = token;
 }); });
</script>

@endsection






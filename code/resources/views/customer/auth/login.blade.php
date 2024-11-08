@extends('layout.web_master')

@section('content')

<div class="content-wrapper">

            <div class="text-center">
                
                <main class="form-signin card mt-8 mb-8">
                    <form  action="{{ route('customer.auth.postemail') }}" method="post">
                        @csrf
                        <h1 class="h3 mb-3 fw-normal">Login</h1>

                        <div class="form-floating  {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email Address">
                            <label for="floatingInput">Email Address</label>
                            @if ($errors->has('email'))
                                <span class="text-danger form-text">
                                    <strong><small>{{ $errors->first('email') }}</small></strong>
                                </span>
                            @endif
                        </div>
                        <input type='hidden' name='recaptcha_token' id='recaptcha_token'>
                        <div class="form-floating mt-3 {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                            @if ($errors->has('password'))
                                <span class="text-danger form-text">
                                    <strong><small>{{ $errors->first('password') }}</small></strong>
                                </span>
                            @endif
                        </div>

                        <div class="checkbox mb-3">
                            <label>
                            <input type="checkbox" value="remember-me"> New here? <a href="{{ route('customer.signup') }}">Signup</a>
                          </label>
                        </div>
                        @if($errors->has('recaptcha_token'))
                            {{$errors->first('recaptcha_token')}}
                        @endif
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                        <a class="mt-3 mb-3 text-muted" href="#">Forgot your password?</a>
                    </form>
                </main>
            
            </div>
        </div>
 
@endsection('content')




@section('web_footer_scripts')

<script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}"></script>
<script>
grecaptcha.ready(function() {
  grecaptcha.execute('{{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}')    .then(function(token) {
   document.getElementById("recaptcha_token").value = token;
 }); });
</script>

@endsection




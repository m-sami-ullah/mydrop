@extends('layout.web_master')

@section('content')

<section id="login-section" class="my-3 py-5">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h5>Signup</h5>
            </div>
        </div>
        <div class="row">
            
                
            
            <div class=" col-sm-6 offset-sm-3 col-md-4 offset-md-4">
                <form class="form card p-3 p-3 pt-5" action="{{ route('customer.register') }}" method="post">

                    {{ csrf_field() }}

                    <input type='hidden' name='recaptcha_token' id='recaptcha_token'>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input id="firstName" name="firstname" value="{{ old('firstname') }}"  type="text" class="form-control" placeholder="First Name">
                                    <label for="firstName">First Name</label>
                                </div>
                                @if($errors->has('firstname'))
                                    <p class="text-danger">{{ $errors->first('firstname') }}</p> 
                                @endif 
                            </div>

                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input id="lastName" name="lastname" value="{{ old('lastname') }}" type="text" class="form-control" placeholder="Last Name">
                                    <label for="lastName">Last Name</label>
                                </div>
                                @if($errors->has('lastname'))
                                    <p class="text-danger">{{ $errors->first('lastname') }}</p> 
                                @endif
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-4">
                                    <input id="email" type="email"   name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required>
                                    <label for="email">Email</label>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-4">
                                    <div class="row">
                                        
                                        <div class="col-4 pe-0">
                                            <select class="form-control">
                                                @foreach ($countries as $country)
                                                <option {{ env('DEFAULT_COUNTRY')== $country->id ? 'selected':'' }}  value="{{ $country->id }}">{{ $country->phonecode }}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                        <div class="col-8 ps-0">
                                            
                                            <input id="phone" type="phone"   name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Phone Number" required>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('phone'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-4">
                                    <input id="password" type="password"   name="password" value="" class="form-control" placeholder="Email" required>
                                    <label for="password">Password</label>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-4">
                                    <input id="password_confirmation" type="password"   name="password_confirmation" value="" class="form-control" placeholder="Confirm Password" required>
                                    <label for="cpassword">Confirm Password</label>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                             
                        </div>
                        <hr class="my-4">
                        @if($errors->has('recaptcha_token'))
                            {{$errors->first('recaptcha_token')}}
                        @endif
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Signup</button>
            
                    
                   
                  
                </form>
            </div>
            
        </div>
    </div>
</section> 
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



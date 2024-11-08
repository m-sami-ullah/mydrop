@extends('layout.web_master')
@section('content')
<div class="container mt-6 mb-6">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('customer.password.confirm') }}">
                        @csrf

                        <div class="form-floating  mt-3 {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}" placeholder="Password" required>
                            <label for="password">Password</label>
                            @if ($errors->has('password'))
                                <span class="text-danger form-text">
                                    <strong><small>{{ $errors->first('password') }}</small></strong>
                                </span>
                            @endif
                        </div>

                       

                        <div class="mb-0 mt-3">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('customer.password.request'))
                                    <a class="btn btn-link mt-2" href="{{ route('customer.password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

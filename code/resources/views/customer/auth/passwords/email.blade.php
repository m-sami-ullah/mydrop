@extends('layout.web_master')

@section('content')
<div class="content-wrapper">

            <div class="text-center">
                
                <main class="form-signin card mt-8 mb-8">
                     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('customer.password.email') }}">
                        {{ csrf_field() }}
                        <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

                        <div class="form-floating  mt-3 {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Email Address" required>
                            <label for="email">Email Address</label>
                            @if ($errors->has('email'))
                                <span class="text-danger form-text">
                                    <strong><small>{{ $errors->first('email') }}</small></strong>
                                </span>
                            @endif
                        </div>

                         

                        <div class="form-group  mt-3 ">
                            <div class=" col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </main>
            
            </div>
        </div>
 
@endsection

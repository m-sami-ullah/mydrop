@extends('layout.oui_master')

@section('content')
 
<section id="login-section" class="my-3 py-5">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h5>{{ trans('lang.enter_code_received') }}</h5>
                <p>{{ trans('lang.send_four_digit_code') }} <br/><b>{{ old('email',$seller['email']) }}</b></p>
            </div>
        </div>
         
        <div class="row">
            <div class="col-sm-6 offset-sm-3 col-md-4 offset-md-4">
                <form class="form" action="{{ route('seller.auth.verifyemailcode') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="email" value="{{ old('email',$seller['email']) }}">
                    <div class="form-group  {{ $errors->has('invalidcode') ? 'has-error' : '' }}">
                        <input type="number" name="code_a" class="code_input first_code_input" max="9" placeholder="-">
                        <input type="number" name="code_b" class="code_input blocked_input"  max="9" placeholder="-">
                        <input type="number" name="code_c" class="code_input blocked_input" max="9" placeholder="-">
                        <input type="number" name="code_d" class="code_input blocked_input last_code_input" max="9" placeholder="-">
                        @if ($errors->has('invalidcode'))
                            <span class="help-block">
                                <strong>{{ $errors->first('invalidcode') }}</strong>
                            </span>
                        @endif
                        @if (session('invalidcode'))
                            <span class="help-block">
                                <strong>{{ session('invalidcode') }}</strong>
                            </span>
                        @endif
                    </div>
                     
                    <div class="form-group text-center">
                        <button class="btn btn-dark">{{ trans('lang.next') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> 
@endsection('content')

@section('oui_footer_scripts')
 
</html><script type="text/javascript">
    jQuery(document).ready(function($) {
        $(document).on('keyup', '.code_input', function(event) {
                $(this).focusout().addClass('blocked_input');
                $(this).next('.code_input').focus().removeClass('blocked_input');
            /* Act on the event */
        });
        $(document).on('keyup', '.last_code_input', function(event) {
            $('.form').submit();
            /* Act on the event */
        });
    });
</script>
@endsection







@extends('layout.web_master')

@section('content')

<section id="login-section" class="my-3 py-5">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h5>Verify Your Account</h5>
            </div>
        </div>
        <div class="row">
            
                
            
            <div  class=" col-sm-6 offset-sm-3 col-md-4 offset-md-4">
                <form class="form card p-3 p-3 pt-5" action="{{ route('customer.register') }}" method="post">

                    {{ csrf_field() }}

                    <input type='hidden' name='recaptcha_token' id='recaptcha_token'>

                        <div class="row g-3">
                            
                        <p class="text-center coderesponse"></p>
                        <div class="form-group " id="authverify">
                            <input autofocus="true" type="number" name="code_a" class="code_input first_code_input" max="9" placeholder="-">
                            <input type="number" name="code_b" class="code_input " max="9" placeholder="-">
                            <input type="number" name="code_c" class="code_input " max="9" placeholder="-">
                            <input type="number" name="code_d" class="code_input  last_code_input" max="9" placeholder="-">
                        </div>
                        <p class="text-gray-dark text-center text-danger px-0 px-md-5 coderesponsemsg"></p>
                      
                             
                        </div>
                        <hr class="my-4">
                        @if($errors->has('recaptcha_token'))
                            {{$errors->first('recaptcha_token')}}
                        @endif
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Verify</button>
            
                    
                   
                  
                </form>
            </div>
            
        </div>
    </div>
</section> 
@endsection('content')





@section('web_footer_scripts')

@parent
<script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}"></script>
<script>
grecaptcha.ready(function() {
  grecaptcha.execute('{{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}')    .then(function(token) {
   document.getElementById("recaptcha_token").value = token;
 }); });
</script>

<style type="text/css">
    input.code_input {
    display: inline-block;
width: 54px;
height: 60px;
margin: 0 10px;
font-size: 36px;
font-weight: 900;
text-align: center;
}
input[type="number"].code_input {
    -moz-appearance: textfield !important;
}
</style>

<script type="text/javascript">
    jQuery(document).ready(function($) 
    {
        $(document).on('keyup', '#authverify .code_input', function(event) 
        {
            
            if(event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 38)
            {
                $(this).prev('#authverify .code_input').focus();

            }else{
                if((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 65 && event.keyCode <= 90) || event.keyCode == 39 || event.keyCode == 40)
                {
                    if($(this).val()!='')
                    {
                        $(this).val(event.originalEvent.key)
                    }

                    $(this).next('#authverify .code_input').focus();
                }
            }

            var a = $('#authverify input[name=code_a]').val()
            var b = $('#authverify input[name=code_b]').val()
            var c = $('#authverify input[name=code_c]').val()
            var d = $('#authverify input[name=code_d]').val()

        
            if(a!='' && b!='' && c!='' && d!='')
            {
                $('.verifyemailcode').removeAttr('disabled')
                $('#code').val(a+b+c+d)
            }else{
                $('.verifyemailcode').attr('disabled','true')
            }

        });


        
    });
</script>
@endsection



@component('mail::message')

@lang('In order to create your Verification Request, please go to your email inbox and verify your email address.') 
@lang('Please confirm your account using the link below.')


@component('mail::button', ['url' => $verificationLink])
@lang('Activate account')
@endcomponent

@lang('Thank you,')  
@lang(env('APP_NAME'))  

@lang('**Please do not reply to this email.**')
@endcomponent
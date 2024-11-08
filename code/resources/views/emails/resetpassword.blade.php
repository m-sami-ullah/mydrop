@component('mail::message')
	
@lang('We received a request to reset your password.')  
@lang('Use the link below to set up a new password for your account.')

@component('mail::button', ['url' => $resetLink])
@lang('Set new password')
@endcomponent

@lang('If you did not make this request, ignore this email. Your password will not change until you create a new password.')  

@lang('Thank you,')  
@lang(env('APP_NAME')) 

@lang('**Please do not reply to this email.**')

@endcomponent

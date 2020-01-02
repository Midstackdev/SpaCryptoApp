@component('mail::message')
# Reset your password.

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $url])
Reset password
@endcomponent

This password reset link will expire in 10 minutes.

If you did not request a password reset, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

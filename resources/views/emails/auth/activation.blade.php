@component('mail::message')
# Please activate your account

Click the button to activate your account.

@component('mail::button', ['url' => ''])
Activate {{ $token }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

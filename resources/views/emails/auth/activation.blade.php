@component('mail::message')
# Please activate your account

Click the button to activate your account.

@component('mail::button', ['url' => $url])
Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

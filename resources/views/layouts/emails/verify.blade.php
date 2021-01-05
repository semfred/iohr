@component('mail::message')
# You are invited to IO Organization

Hello, you are invited to be a part of Intelligent Outsourcing

@component('mail::button', ['url' => $url, 'color'  =>  'red'])
Accept invitation
@endcomponent

If you did not create an account, no further action is required.

Regards,<br>
<strong><span style="color:#EA2036;">Intelligent</span> <span style="color:#6D7172;">Outsourcing</span></strong>
@endcomponent

@component('mail::message')
# Hello,

This is a test email.

@component('mail::button', ['url' => ''])
Test
@endcomponent

Thanks,<br>
Nolan Bowl
@endcomponent

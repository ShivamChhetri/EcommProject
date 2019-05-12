@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => 'http://ecomapp.me/api/verify/'.$user->remember_token])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

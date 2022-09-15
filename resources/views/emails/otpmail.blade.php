@component('mail::message')
# Welcome

EDGE

<h3>VERIFY YOUR LOGIN</h3>

The verification code is: {{ $data }}

Thanks,<br>
{{ config('app.name')}}

@endcomponent
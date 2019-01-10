{{-- mailtrap template --}}
@component('mail::message')

Bonjour, {{ $fullname }}<br><br>

{{ $message}}
<br>
{{ config('app.name') }}

@endcomponent
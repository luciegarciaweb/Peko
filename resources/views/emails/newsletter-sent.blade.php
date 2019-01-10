@component('mail::message')
# Bonjour

{{ $body }}

Merci,<br>
{{ config('app.name') }}
@endcomponent

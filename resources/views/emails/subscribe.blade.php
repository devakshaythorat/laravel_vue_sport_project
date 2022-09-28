@component('mail::message')
# Sports News

Thank you for subscribing to {{$sport->title}} Channel

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Introduction
{{ $info->email }}
Your order has been confirmed :)))

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

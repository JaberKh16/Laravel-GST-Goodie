{{-- <x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}-------------------------------------------------
</x-mail::message> --}}


@component('mail::message')
# Reset Your Password

You are receiving this email because we received a password reset request for your account.
@if ($token)
    @component('mail::button', ['url' => route('password.reset', ['token' => $token])])
    Reset Password
    @endcomponent
@endif


If you did not request a password reset, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

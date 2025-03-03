<x-mail::message>
# Introduction

WELCOME , Your Email Has Been Added successfully !!.

<x-mail::button :url="route('frontend.index')">
Visit Our Website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

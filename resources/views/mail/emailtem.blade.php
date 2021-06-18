@component('mail::message')
# Introduction

<h1> The body of your message. </h1>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent 

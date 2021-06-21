@component('mail::message')

<h1>
Hey {{ $user->name }}, 
</h1>

<h3>
{{ $author }} has published a new post
</h3>

<h1> {{ $title }} </h1>
@component('mail::button', ['url' => $url])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

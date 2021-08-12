@component('mail::message')

<h1>
Hey {{ $user->name }}, 
</h1>

<h3>
{{ $author }} has published a new article
</h3>

<div style="margin-top: 50px;">
<h1 style="font-size: 30px;"> {{ $title }} </h1>
</div>
@component('mail::button', ['url' => $url])
Read Article
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

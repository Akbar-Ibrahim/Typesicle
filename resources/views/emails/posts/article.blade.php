@component('mail::message')

<h1>
Hey!
</h1>
<br>
<h3>
Check out this article I just read. It was published by 
<a href="{{ route('profile.show', $post->user->username) }}">
{{ $post->user->name }}
</a>
on 
<a href="{{ route('welcome') }}">
<b> Typesicle </b>
    </a>
</h3>
<br>
<div style="margin-top: 50px;">
<h1 style="font-size: 30px;"> <storng> {{ $post->title }} </strong> </h1>
</div>
@component('mail::button', ['url' => $route])
Read Article
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

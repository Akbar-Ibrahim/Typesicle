@extends('layouts.home')

@section('styles')


@endsection

@section('content')

<header>
    <div class="w3-container">
        <h2>Notifications</h2>
    </div>
</header>

<div class="w3-container">
    <div class="w3-row">
        <div class="w3-col l8">

            <div class="">
                @foreach($notifications as $notification)
                @if($notification->type === 'post')

                <div class="d-flex w3-border w3-padding w3-margin-bottom ">
                    <div class="flex-grow-1">
                        <div> <a href="{{ route('profile.show', $notification->is_notifier->username) }}">
                                {{ $notification->is_notifier->name }}
                            </a>
                            {{ $notification->message }}
                            <a
                                href="{{ route('post.url', [$notification->feed->post->user->username, $notification->feed->post->url, $notification->feed->id]) }}">
                                {{  $notification->feed->post->title }}
                            </a>
                        </div>

                    </div>

                    <div>
                        {{ $notification->date }}
                    </div>
                </div>

                @elseif($notification->type === 'like')
                @if ($notification->feed->post)
                <div class="d-flex w3-border w3-padding w3-margin-bottom ">
                    <div class="flex-grow-1">
                        <div> <a href="{{ route('profile.show', $notification->is_notifier->username) }}">
                                {{ $notification->is_notifier->name }}
                            </a>
                            {{ $notification->message }}
                            <a
                                href="{{ route('post.url', [$notification->feed->post->user->username, $notification->feed->post->url, $notification->feed->id]) }}">
                                {{  $notification->feed->post->title }}
                            </a>
                        </div>

                    </div>

                    <div>
                        {{ $notification->date }}
                    </div>
                </div>
                @elseif($notification->feed->shortie)

                <div class="d-flex w3-border w3-padding w3-margin-bottom ">
                    <div class="flex-grow-1">
                        <div> <a href="{{ route('profile.show', $notification->is_notifier->username) }}">
                                {{ $notification->is_notifier->name }}
                            </a>
                            {{ $notification->message }}

                        </div>

                        <div class="t">
                            <div class="w3-container">
                            {!! $notification->feed->shortie->shortie !!}
                            </div>

                            @if($notification->feed->shortie->shortiePhoto)
                            <div class="w3-container">
                            Shortie has {{ count($notification->feed->shortie->shortiePhoto) }} photo(s)
                            </div>
                            @endif
                        </div>

                    </div>

                    <div>
                        {!! $notification->date !!}
                    </div>
                </div>


                @endif

                @elseif($notification->type === 'share')
                @if ($notification->feed->post)
                <div class="d-flex w3-border w3-padding w3-margin-bottom ">
                    <div class="flex-grow-1">
                        <div> <a href="{{ route('profile.show', $notification->is_notifier->username) }}">
                                {{ $notification->is_notifier->name }}
                            </a>
                            {{ $notification->message }}
                            <a
                                href="{{ route('post.url', [$notification->feed->post->user->username, $notification->feed->post->url, $notification->feed->id]) }}">
                                {{  $notification->feed->post->title }}
                            </a>
                        </div>

                    </div>

                    <div>
                        {{ $notification->date }}
                    </div>
                </div>
                @elseif($notification->feed->shortie)

                <div class="d-flex w3-border w3-padding w3-margin-bottom ">
                    <div class="flex-grow-1">
                        <div> <a href="{{ route('profile.show', $notification->is_notifier->username) }}">
                                {{ $notification->is_notifier->name }}
                            </a>
                            {{ $notification->message }}

                        </div>

                        <div class="t">
                            {!! $notification->feed->shortie->shortie !!}
                        </div>

                    </div>

                    <div>
                        {!! $notification->date !!}
                    </div>
                </div>


                @endif


                @elseif($notification->type === 'follow')

                <div class="d-flex w3-border w3-padding w3-margin-bottom ">
                    <div class="flex-grow-1">
                        <div> <a href="{{ route('profile.show', $notification->is_notifier->username) }}">
                                {{ $notification->is_notifier->name }}
                            </a>
                            {{ $notification->message }}
                        </div>

                    </div>

                    <div>
                        {{ $notification->date }}
                    </div>
                </div>

                @elseif($notification->type === 'comment')
                <div class="d-flex w3-border w3-padding w3-margin-bottom ">
                    <div class="flex-grow-1">
                        <div> <a href="{{ route('profile.show', $notification->is_notifier->username) }}">
                                {{ $notification->is_notifier->name }}
                            </a>
                            {{ $notification->message }}
                            <a
                                href="{{ route('post.url', [$notification->user->username, $notification->feed->post->url, $notification->feed->id]) }}">
                                {{  $notification->feed->post->title }}
                            </a>
                        </div>

                        <div class=""> {!! $notification->comment->body !!} </div>

                    </div>

                    <div>
                        {{ $notification->date }}
                    </div>
                </div>
                @endif
                @endforeach
            </div>


        </div>

        <div class="w3-col l4">

        </div>
    </div>
</div>

@endsection

@section('scripts')



@endsection
@extends('layouts.home')

@section('styles')


@endsection

@section('content')

<header>
    <div class="w3-container" style="margin-left: 50px;">
        <h2>Notifications</h2>
    </div>
</header>

<div class="w3-container">
    <div class="w3-row-padding">
        <div class="w3-col l9">

            <div class="w3-container">
                @foreach($notifications as $notification)
                @if($notification->comment_id)
                <div class="d-flex w3-border w3-padding w3-margin ">
                    <div class="flex-grow-1">
                        <div> <a href="{{ route('profile.show', $notification->is_notifier->username) }}">
                                {{ $notification->is_notifier->name }}
                            </a>
                            {{ $notification->message }}
                            <a
                                href="{{ route('post.url', [$notification->user->username, $notification->post->url, $notification->post->feed->id]) }}">
                                {{  $notification->post->title }}
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
    </div>
</div>

@endsection

@section('scripts')



@endsection
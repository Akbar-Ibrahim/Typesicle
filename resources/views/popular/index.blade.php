@extends('layouts.home')

@section('styles')

<style>
.content {
    max-width: 800px;
    margin: auto;
}


</style>

@endsection

@section('content')


<div class="content">
    <div class="w3-row">

        <div class="w3-col m12 ">
            <div class="w3-container w3-center ">
                <h1 class="w3-hide-small w3-hide-medium">Popular on Typesicle </h1>
                <h1 style="font-size: 75px;" class="w3-hide-large"> <b> Popular on Typesicle </b> </h1>
            </div>

            @foreach($posts as $post)
            <div class="d-flex w3-margin w3-padding ">
                <div style="margin-right: 20px; padding-top: 20px;">
                    <a href="{{ route('profile.show', $post->user->username) }}">
                        @if ($post->user->profile->picture == 'avatar.png')
                        <img src="/images/avatar.png" alt="Avatar" class="w3-center w3-circle w3-border"
                            style="width: 35px;" />
                        @else
                        <img src="`/images/{{$post->user->id}}/profile_pic/{{$post->user->profile->picture}}`"
                            alt="Avatar" class="w3-center w3-circle w3-border" style="width: 35px;" />
                        @endif
                    </a>
                </div>

                <div class="flex-grow-1">
                    <div>
                    <a style="text-decoration: none;" href="{{ route('post.url', [$post->user->username, $post->url, $post->feed->id]) }}">
                        <h1 class="w3-hide-small w3-hide-medium">{{ $post->title }} </h1>
                        <h1 style="font-size: 40px;" class="w3-hide-large"> <b> {{ $post->title }} </b> </h1>
                    </a>
                    </div>
                    <div>
                        <a href="{{ route('profile.show', $post->user->username) }}"> {{ $post->user->name }} </a>
                    </div>

                </div>
            </div>
            @endforeach



        </div>


        <!-- Right side -->




    </div>

</div>


@endsection

@section('scripts')


@endsection
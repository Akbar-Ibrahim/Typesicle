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

@include('includes.loadBlock')
<div class=" content" style="display: none;" id="wrapper-div">
    <div class="w3-row">


    @if(1)
    <!-- <h1 class="w3-center" style="font-size: 260px; "> &#128516 </h1> -->
    <!--  -->
    <h1 class="w3-center" style="font-size: 260px; "> &#128039; </h1>
    
    
    <div class="w3-container w3-center">
    <div class="w3-margin"> This page is an endangered species</div>
    <a class="btn btn-primary lawngreen w3-text-white" style="font-size: 30px; text-decoration: none;" href="{{ route('welcome') }}"> Click to save it  </a>
    </div>
    
    @else
        <div class="w3-col m12 ">
            <div class="w3-container ">
                <h1>Popular on Typesicle </h1>
            </div>

            @foreach($posts as $post)
            <div class="d-flex w3-margin w3-padding ">
                <div style="margin-right: 20px; padding-top: 20px;">
                    <a href="{{ route('profile.show', $post->user->username) }}">
                        @if ($post->user->profile->picture == 'avatar.png')
                        <img src="/images/avatar.png" alt="Avatar" class="w3-center w3-circle w3-border"
                            style="width: 35px;" />
                        @else
                        <img src="`/images/{{$post->user->id}}/profile_pic/{{$post->user->profile.picture}}`"
                            alt="Avatar" class="w3-center w3-circle w3-border" style="width: 35px;" />
                        @endif
                    </a>
                </div>

                <div class="flex-grow-1">
                    <div>
                    <a style="text-decoration: none;" href="{{ route('post.url', [$post->user->username, $post->url, $post->feed->id]) }}">
                        <h1>{{ $post->title }} </h1>
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



@endif
    </div>

</div>


@endsection

@section('scripts')
<script src="{{ asset('js/loadBlock.js') }}"></script>


@endsection
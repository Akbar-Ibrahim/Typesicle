@extends('layouts.home')

@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">
<style>
.content {
    max-width: 800px;
    margin: auto;
}
</style>
@endsection

@section('content')

<div class="w3-container content">
    <div class="w3-row-padding">

<div class="w3-container">
    <h1 class="w3-hide-small w3-hide-medium">Trending</h1>
    <h1 style="font-size: 60px;" class="w3-hide-large"> <b> Trending </b> </h1>
</div>

        @if(count($top_hashtags) > 0)
        <div class="" >

            @foreach($top_hashtags as $hashtag)
            <div class="w3-hide-small w3-hide-medium w3-padding w3-border"> <a style="text-decoration: none;" href="{{ route('hashtags.hashtag', str_replace('#', '', $hashtag->hashtag)) }}">
                    {{ $hashtag->hashtag }} </a> </div>
                    <div class="w3-hide-large w3-padding w3-border"> <a style="text-decoration: none; font-size: 30px;" href="{{ route('hashtags.hashtag', str_replace('#', '', $hashtag->hashtag)) }}">
                    {{ $hashtag->hashtag }} </a> </div>

            @endforeach
        </div>
        @else
        <div class="w3-container">
            <h1 class="w3-hide-small w3-hide-medium">Nothing to see here :)</h1>
            <h1 style="font-size: 60px;" class="w3-hide-large"> <b> Nothing to see here :) </b> </h1>
        </div>
        @endif



    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/profiles.js') }}" defer></script>

@endsection
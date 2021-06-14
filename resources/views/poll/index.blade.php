@extends('layouts.home')

@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">
<style>
.one-image img:hover,
.w3-third img:hover,
.w3-half img:hover,
.w3-quarter img:hover {
    opacity: 0.6;
    transition: 0.3s
}
</style>
@endsection

@section('content')

<div class="w3-main" style="margin-top:43px;">

    <div class="w3-container">
        <h2>Quizzes</h2>

        @foreach($quizzes as $quiz)
        <div class="w3-container">
            <a href="{{ route('play.quiz', $quiz->id) }}"> {{$quiz->name}} </a>
        </div>

        @if(Auth::user()->id == $quiz->user_id)
        <div class="w3-container">
            <a href="{{ route('stats.quiz', $quiz->id) }}"> Stats </a>
        </div>
        @endif
        @endforeach
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/profiles.js') }}" defer></script>



@endsection
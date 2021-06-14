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

        @auth
        @if(Auth::user()->id == $user->id)
        <button route="{{ route('quiz.create') }}" onclick="location.href=this.getAttribute('route')"
            class="py-2 mx 2">Create Quiz</button>
        @endif
        @endauth

@if(count($quizzes) > 0)

        @foreach($quizzes as $quiz)
        @if($quiz->status == 'saved')
        @auth
        @if($quiz->status == 'saved' && $quiz->user_id == Auth::user()->id)
        <div class="w3-padding"> Undone </div>
        @endif

        @if(Auth::user()->id == $quiz->user_id)
        <div class="w3-container">
            <h3>
                <a href="{{ route('quiz.edit', $quiz->id) }}"> {{ $quiz->title ?? 'Untitled' }} </a>
            </h3>
        </div>


        <div class="w3-container">
            <a href="{{ route('quiz.edit', $quiz->id) }}"> Continue creating </a> |
        </div>
        @endif

        <hr class="w3-clear">
        @endauth
        @else
        <div class="w3-container">
            <h3>
                <a href="{{ route('quiz.show', $quiz->id) }}"> {{$quiz->title ?? 'Untitled' }} </a>
            </h3>
            <p> {{ $quiz->description }} </p>
        </div>

        @auth
        @if(Auth::user()->id == $quiz->user_id)
        <div class="w3-container">
            <a href="{{ route('quiz:stats', $quiz->id) }}"> Stats </a> |
        </div>
        @endif
        @endauth
        <hr class="w3-clear">
        @endif
        @endforeach
    </div>
</div>

@else
<div class="w3-container w3-center w3-padding">
<h1>Nothing to see here :)</h1>
</div>
@endif
@endsection

@section('scripts')
<script src="{{ asset('js/profiles.js') }}" defer></script>



@endsection
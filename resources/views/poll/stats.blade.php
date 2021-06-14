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
        <div class="w3-container w3-margin w3-padding">
            <h2> {{ $quiz->name }} quiz </h2>
        </div>

        @if(count($stats) > 0)
        <table class="w3-table w3-striped w3-bordered w3-margin">
            <tr>
                <th> Player </th>
                <th>Correct</th>
                <th>Wrong</th>
                <th>Unanswered</th>
                <th>Questions Correct</th>
                <th>Questions Wrong</th>
                <th>Questions Unanswered</th>
                <th>Score</th>
            </tr>
            @foreach($stats as $stat)
            <tr>
                <td> {{ $stat->user->name }} </td>
                <td> {{ $stat->correct }} </td>
                <td> {{ $stat->wrong }} </td>
                <td> {{ $stat->unanswered }} </td>
                <td> {{ $stat->questions_correct }} </td>
                <td> {{ $stat->questions_wrong }} </td>
                <td> {{ $stat->questions_unanswered }} </td>
                <td> {{ $stat->correct . '/' . $stat->total }} </td>

            </tr>

            @endforeach
        </table>

        @else
        <h4>No one has played this quiz yet</h4>
        @endif
    </div>


</div>

@endsection

@section('scripts')
<script src="{{ asset('js/profiles.js') }}" defer></script>



@endsection
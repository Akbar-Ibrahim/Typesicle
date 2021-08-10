@extends('layouts.home')

@section('content')

@if(count($comments) > 0)
<comments-component user-id="{{ Auth::user()->id }}">
</comments-component>

@else
<div class="w3-container w3-center " style="margin-top: 250px;">
    You don't have any comments yet
</div>
@endif
@endsection
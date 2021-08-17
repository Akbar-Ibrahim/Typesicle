@extends('layouts.master')

@section('styles')

<style>
.content {
    max-width: 800px;
    margin: auto;
}
</style>

@endsection

@section('content')


<div class=" content">
    <div class="w3-row">

        <div class="w3-center">
            <h3>Email was successfully sent.</h3>
            <p> Go back to <a href="{{ $route }}">{{ $post->title }} </a> </p>
            <br>

            <p> <a href="{{ route('welcome') }}">  Home </a> </p>
        </div>

    </div>

</div>


@endsection

@section('scripts')



@endsection
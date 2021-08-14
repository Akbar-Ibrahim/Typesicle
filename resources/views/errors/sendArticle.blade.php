@extends('layouts.home')

@section('styles')

<style>
.content {
    max-width: 600px;
    margin: auto;
}
</style>

@endsection

@section('content')


<div class=" content" id="wrapper-div">
    <div class="w3-row">

        <div class="w3-center">
            <h3>Something went wrong</h3>
            <p> Make sure the email is correct. </p>
            <p> Resend <a href="{{ $route }}">{{ $post->title }}</a>? </p>
            

            <form method="POST" action="{{ route('email-post') }}" class="emailPost">
                @csrf
                <input type="hidden" name="feed_id" value="{{ $feed->id }}">
                <input type="hidden" name="post_id" value="{{ $feed->post->id }}">

                <input class="py-1" type="email" name="recipient" placeholder="Enter email"
                    style="width: 80%; border: none; ">
                <button class="emailPost w3-button">Send</button>
            </form>

            <a href="{{ $route }}">Go back </a>
        </div>

    </div>

</div>


@endsection

@section('scripts')



@endsection
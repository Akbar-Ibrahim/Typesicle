@extends('layouts.write')

@section('styles')
<style>
.content {
    max-width: 600px;
    margin: auto;
}
</style>


@endsection

@section('content')


<div class="w3-container content w3-border " style="margin-top: 100px;">
    <div class="w3-row-padding">
        
        <div class=" ">

            <div>
                <a class="w3-button" href="/home">Home</a>
                <a class="w3-button" href="/{{ $user->username }}">My Profile</a>
            </div>

            <div class="w3-container w3-center" style="font-size: 27px; margin-top: 50px;">
                <a class="w3-button w3-border" href="/write/create"> Write an article </a>
            </div>



            <div>
                <div class="w3-container w3-center" style="font-size: 27px; margin-top: 50px;">
                    <a class="w3-button w3-border" href="/shortie/create"> Write a shortie </a>
                </div>
                <div class="w3-container w3-center">
                    <div style="width: 80%; margin-left: auto; margin-right: auto;" class="w3-padding "> A shortie is a
                        Twitter-style post with a limit of four picture uploads
                        and 750 characters </div>
                </div>

            </div>
        </div>

    

    </div>
</div>


@endsection

@section('scripts')
<!-- <script src="{{ asset('js/app.js') }}"></script> -->


@endsection
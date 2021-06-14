@extends('layouts.home')

@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">
<style>
a {
    text-decoration: none;
}

div.scrollmenu {
    background-color: #333;
    overflow: auto;
    white-space: nowrap;
}

div.scrollmenu button {
    display: inline-block;
    color: white;
    text-align: center;
    text-decoration: none;
}

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

<div class="">

    <div class="w3-container">
        <div class="w3-row">
            <div class="w3-col l8">

                @if($feed)
                @guest
                <view-shortie-component user-id="0" shortie="{{ json_encode($feed) }}" shorties="{{ json_encode($feed) }}"
                    user="{{ json_encode($user) }}" user-type="auth"></view-shortie-component>
                @else
                <view-shortie-component user-id="{{ Auth::user()->id }}" shortie="{{ json_encode($feed) }}" shorties="{{ json_encode($feed) }}"
                    user="{{ json_encode($user) }}" user-type="auth"></view-shortie-component>
                @endauth
                    @endif

                    <div class="w3-container my-4">

                    </div>

                </div>




                <div class="w3-col l4 w3-hide-small">
                    
                </div>

            </div>
        </div>

    </div>

    @include('includes.imageModal')

    @endsection

    @section('scripts')
    <script>
    function showImage(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";

    }

    $(document).ready(function() {


        var shorties = document.getElementsByClassName("shortie");
        shorties[0].style.fontSize = "30px";

    });
    </script>

    @endsection('scripts')
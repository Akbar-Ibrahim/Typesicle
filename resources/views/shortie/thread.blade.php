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

<div class="w3-container">

    <div class="w3-container">
        <div class="w3-row-padding">
            <div class="w3-twothird">

                @if($feed)
                <div class="w3-border" style="margin-top: 50px;">

                    @foreach($feed->thread->shorties as $shortie)
                    <header-component user="{{ json_encode($shortie->use) }}"
                        date="{{ $shortie->created_at->toFormattedDateString() }}" size="width: 35px">
                    </header-component>

                    <shortie-component shortie-id="{{ $shortie->id }}" user-id="{{ Auth::user()->id }}"
                        shortie="{{ json_encode($shortie) }}"
                        route="{{ route('thread.url', [$shortie->user->username, $shortie->thread->feed->id])  }}"
                        height="{{ count($shortie->shortiePhoto) == 1 ? '550px' : '250px' }}"
                        smallscreen-height="{{ count($shortie->shortiePhoto) == 1 ? '300px' : '150px' }}">
                        {!! $shortie->shortie !!}
                    </shortie-component>

                    
                @endforeach
                </div>
                @endif

                <div class="w3-container my-4">
                    <comment-component user-id="{{auth()->check()? auth()->user()->id : -1}}" post-id="{{ $feed->id }}">
                    </comment-component>
                </div>

            </div>




            <div class="w3-third">
                @include('shortie.recent')
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
    //   var captionText = document.getElementById("caption");
    //   captionText.innerHTML = element.alt;
}

$(document).ready(function() {

    var shorties = document.getElementsByClassName("shortie");
    shorties[0].style.fontSize = "30px";

    
});
</script>

@endsection('scripts')
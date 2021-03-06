@extends('layouts.home')

@section('styles')

<link href="{{ asset('css/shortie.css') }}" rel="stylesheet">
<style>
div.scrollmenu {
    background-color: #333;
    overflow: auto;
    white-space: nowrap;

}

.horizontal-image-gallery {
    display: inline-block;
}

/* Hide scrollbar for Chrome, Safari and Opera */
.scrollmenu::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.scrollmenu {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}

#modal-heading {
    overflow: hidden;
    /* background-color: #333; */
    width: 100%;
}


.content {
    padding: 16px;
}

.sticky {
    position: fixed;
    top: 0;
    /* width: 50%; */
}

.sticky+.content {
    padding-top: 60px;
}

a {
    text-decoration: none;
}

div img:hover {
    opacity: 0.6;
    transition: 0.3s
}
</style>

@endsection

@section('content')
@include('includes.urls')
@include('includes.imageModal')
@include('includes.loadBlock')
<div class="w3-container">


    @auth
    <div class="w3-margin w3-padding w3-border w3-hide-large">
        <user-component current-user="{{ $user->id }}" user-id="{{ Auth::user()->id }}" usertype="auth"
            user="{{ json_encode($user) }}" status="{{Auth::user()->isFollowing($user->profile->id) ? 1 : 0}}" page="profile">
        </user-component>
    </div>

    @include('profiles.auth')
    @else
    <div class="w3-margin w3-padding w3-border w3-hide-large">
        <user-component current-user="{{ $user->id }}" user-id="{{ 0 }}" usertype="guest"
            user="{{ json_encode($user) }}" page="profile">
        </user-component>
    </div>

    @include('profiles.guest')
    @endauth
</div>


@endsection

@section('scripts')

<!-- <script src="{{ asset('js/queue.js') }}"></script> -->
<!-- <script src="{{ asset('js/like.js') }}"></script> -->
<!-- <script src="{{ asset('js/create-shortie.js') }}" defer></script> -->
<!-- <script src="{{ asset('js/autosize.min.js') }}"></script> -->
<!-- <script>
    autosize(document.querySelectorAll('textarea'));
    // autosize($('textarea'));
    </script> -->


<script>
function showModal(element) {
    document.getElementById("img01").src = element.src;
    document.getElementById("modal01").style.display = "block";
    var captionText = document.getElementById("caption");
    //   captionText.innerHTML = element.alt;
    captionText.innerHTML = element.getAttribute('description');
}

// $(document).ready(function () {
//     $(".pumpum").click(function(){
//         alert("hey")
//     });
// });
</script>

<!-- <script src="{{ asset('js/shortie.js') }}" defer></script>
<script src="{{ asset('js/create-shortie.js') }}" defer></script> -->

@endsection
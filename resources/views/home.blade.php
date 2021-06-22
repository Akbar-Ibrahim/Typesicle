@extends('layouts.home')

@section('styles')
<style>
#hashtags {
    overflow: hidden;
}

.sticky {
    position: fixed;
    top: 0;
    width: 100%;
}
</style>
@endsection

@section('content')
<div class="w3-container">
    <div class="w3-row ">
        <div class="w3-col l8">
            <div class="card">
                <!-- <div class="card-header">Dashboard</div> -->

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if( count($user->follows) == 0 && count($user->profile->follows) == 0 )
                    <div class="w3-container">
                        <div class="w3-container">
                            <h4 class="w3-center"> Posts from people you follow will appear here </h4>
                        </div>

                        <div class="w3-container w3-center" style="margin-top: 50px;">

                            <!-- <button class=" " style="padding: 40px 40px; font-size: 30px;"
                                route="{{ route('write.create') }}" onclick="location.href=this.getAttribute('route')">
                                Publish an article </button> -->
                        </div>
                    </div>
                    @else
                    <feed-component posts="{{ json_encode($feeds) }}" user-id="{{ Auth::user()->id }}"
                        user="{{ json_encode($user) }}">
                    </feed-component>
                    @endif

                </div>
            </div>
        </div>

        <div class="w3-col l4">
            @if (count($top_categories) > 0)
            <div class="w3-container" style="margin-bottom: 30px;">
                <div class="w3-container w3-center">
                    <h5> Top Categories </h5>
                </div>
                <div id="firstTen" class="w3-container topCategory">
                    @foreach($top_categories->take(10) as $category)

                    <div class="w3-container py-2">
                        <a href="{{ route('category-name', [$category->user->username, $category->url]) }}">
                            {{ $category->name }} </a> by
                        <a href="{{ route('profile.show', $category->user->username) }}">
                            {{ $category->user->name }} </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="w3-container">
                <div class="w3-container" id="hashtags">
                    @if(count($top_hashtags) > 0)
                    <div class="w3-container" style="margin-top: 80px;">
                        <h4> Trending Now </h4>

                        @foreach($top_hashtags as $hashtag)
                        <div class="py-2"> <a href="{{ route('hashtag', str_replace('#', '', $hashtag->hashtag)) }}">
                                {{ $hashtag->hashtag }} </a> </div>

                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- <script src="{{ asset('js/like.js') }}"></script> -->


<script>
window.onscroll = function() {
    stickySide()
};

var hashtags = document.getElementById("hashtags");
var sticky = hashtags.offsetTop;

function stickySide() {
    if (window.pageYOffset >= sticky) {
        hashtags.classList.add("sticky")
    } else {
        hashtags.classList.remove("sticky");
    }
}
</script>

<script>
$(document).ready(function() {

    $(document).keydown(function(event) {
        if (event.keyCode == 27) {
            $('.w3-modal').hide();

        }
    });
});
</script>
@endsection
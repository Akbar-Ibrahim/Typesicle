@extends('layouts.home')

@section('styles')

<link rel="stylesheet" href="{{ asset('css/uploadfiles.css') }}">
<!-- <link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet"> -->


@endsection


@section('content')

<div class="w3-container">

</div>

<div class="w3-container" style="margin-top: 50px;">
    <div class="w3-row">

        <div class="w3-col l9">

            <!-- In response to -->



            <!-- Publish form -->
            <div class="">
                <form method="POST" action="{{ route('post.repost', $feed->id) }}" enctype="multipart/form-data">
                    @csrf

                    <header class="w3-container w3-teal">
                        <span ref="close" @click="closeRepostModal" class="w3-button w3-display-topright">&times;</span>
                        <h1>{{ $feed->post->title }}</h1>
                    </header>

                    <div class="w3-container">
                        <h5>Add a comment before reposting(Optional)</h5>

                        <input type="hidden" name="feed_id" value="{{ $feed->id }}">
                        <input type="hidden" name="post_id" value="{{ $feed->post->id }}">
                        <input type="hidden" name="status" value="1">
                        <input type="hidden" name="route" value="/post/{{ $feed->post->user->username }}/{{ $feed->post->url }}/{{ $feed->id }}">

                        <textarea class="form-control" id="summernote" name="repost_message" ref="thought" v-model="thought"
                            cols="10" rows="10"></textarea>

                        <div class="w3-container">
                            <button @click="handleRepost" class="repost w3-button" type="submit">Repost</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>

        <div class="w3-col l3">



        </div>

    </div>
</div>


@endsection

@section('scripts')

<script>
$(document).ready(function() {
    $('#summernote').summernote({
        height: 300,

    });



});

function saveToDrafts() {
    var myForm = document.getElementById("postCreateForm");
    document.getElementById('title').removeAttribute('required');
    // document.getElementsByTagName('select')[0].removeAttribute('required');
    document.getElementsByTagName('textarea')[0].removeAttribute('required');
    myForm.action = "/draft";

}


function publishPost() {
    var myForm = document.getElementById("draftForm");
    var hiddenMethod = document.getElementById("method");
    hiddenMethod.value = "";
    myForm.action = "{{ route('write.store') }}";


}
</script>

@endsection
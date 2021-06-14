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

        <div class="w3-col l8">

            <!-- In response to -->

            <div class="w3-container">
                @if($feed)
                <h6 class="px-4"> You're writing a response to: <a
                        href="{{ route('post.url', [$feed->user->username, $feed->post->url, $feed->id]) }}">
                        {{ $feed->post->title }} </a> by <a
                        href="{{ route('profile.show', $feed->user->username) }}">
                        {{ $feed->post->user->name }} </a> </h6>
                @endif
            </div>

            <!-- Publish form -->
            <div class="">
                <form id="postCreateForm" method="POST" action="/write" enctype="multipart/form-data">
                    @csrf

                    <div class="w3-container w3-right my-2" style="display: none;">
                        <div class="w3-right">
                            <button id="publish" type="submit" class="w3-button">
                                {{ __('Publish Post') }}
                            </button>
                            <button id="save" onclick="saveToDrafts()" type="submit" class="w3-button">
                                {{ __('Save to drafts') }}
                            </button>
                        </div>
                    </div>

                    <div class="w3-container">
                        <input id="cover_photo" type="hidden" name="cover_photo" value="">

                        @if($feed)
                        <input type="hidden" name="responding_to" value="{{ $feed->post->id }}">
                        @endif
                        <input id="url" type="hidden" class="py-4 form-control @error('url') is-invalid @enderror"
                            name="url" value="{{ old('url') }}" autocomplete="url">

                        <input type="hidden" class="py-4 form-control @error('user_id') is-invalid @enderror"
                            name="user_id" value="{{ Auth::user()->id }}">

                    </div>

                    @component('components.editor')
                    @slot('photo')
                    {{ old('photo_id') }}
                    @endslot

                    @slot('category_id')

                    @endslot

                    @slot('category')

                    @endslot

                    @slot('title')
                    {{ old('title') }}
                    @endslot

                    <div id="image-preview-container" class="mb-4 w3-display-container"
                        style="display: none; width: 80%; margin-left:auto; margin-right: auto;">
                        <img id="img_preview" src="" alt="" class="postImage " width="100%" height="300px"
                            style="object-fit: cover; ">
                        <div id="removeCoverImage" class="w3-display-topright"
                            style="cursor: pointer; top: 8px; right: 16px; font-size: 37px;"
                            class="top-right py-2 px-2">X</div>
                    </div>

                    @slot('body')
                    {{ old('body') }}
                    @endslot

                    @endcomponent





                </form>

            </div>

        </div>

        <div class="w3-col l4">
        <div class="w3-container" style="margin-top: 100px;">
                        <div class="w3-half w3-center">
                            <button id="preClickPublish" style="width: 100%" type="submit" class="w3-padding">
                                {{ __('Publish') }}
                            </button>
                            </div>
                            <div class="w3-half w3-center">
                            <button id="preClickSave" style="width: 100%" type="submit" class="w3-padding">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>

            <div class="w3-containere w3-border w3-center w3-margin">
                        @include('includes.addMedia')

            </div>

            <div class="w3-container w3-margin w3-center w3-border writing-options-item">
                <button class="w3-button my-categories-button">Select Category</button>
            </div>


            <div class="my-categories mb-4" style="display: none;">
                <div class="w3-right my-2">
                    <button class="my-categories-close-button w3-button">Close
                    </button>
                </div>
                <div class="py-4">
                    <createcategory-component username="{{ Auth::user()->username }}"></createcategory-component>
                </div>
            </div>



        </div>

    </div>
</div>

@component('components.errorModal')
<div class="w3-container">
    <p>Please, upload an image.</p>
    <p>The formats supported are GIF, PNG & JPG. :)</p>
</div>
@endcomponent

@include('includes.coverPhoto')

@endsection

@section('scripts')

<script src="{{ asset('js/preview-image.js') }}"></script>

<script>
// $(document).ready(function() {
//     $('#summernote').summernote({
//         height: 300,
        

//     });
// });


function photosOverlay(element) {

    document.getElementById("photosOverlay").style.display = "block";
    document.getElementById("coverPhotoModal").style.display = "none";
}


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

// function showCoverImage() {
//     if (document.getElementById("image-preview-container").getAttribute("photo") == "") {
//         document.getElementById("image-preview-container").style.display = "none"
//     } else {
//         document.getElementById("image-preview-container").style.display = "block"
//     }
    

// }

// setTimeout(showCoverImage, 2000);


$(document).ready(function() {

    $('#preClickPublish').click(function() {
        $("#publish").click();
    });

    $('#preClickSave').click(function() {
        $("#save").click();
});

    $('#addCoverImage').click(function() {
        $("#coverPhotoModal").hide();
        $('#upload_pic').click();
    });

    $('.photo').click(function() {
        let pic = $(this).attr('file');
        $('#img_preview').attr('src', pic);
        $('#image-preview-container').css('display', 'block')

        $("#cover_photo").val(pic);


    });

    $('#removeCoverImage').click(function() {

        $('.postImage').attr('src', '');
        $("#image-preview-container").css("display", "none");
        $("#upload_pic").val("");
        $('#cover_photo').val("");

    });

    $('.my-categories-button').click(function() {
        $(".my-categories").css("display", "block");
        $(".writing-options-item").css("display", "none");

    });

    $('.my-categories-close-button').click(function() {
        $(".my-categories").css("display", "none");
        $(".writing-options-item").css("display", "block");

    });




});
</script>

@endsection
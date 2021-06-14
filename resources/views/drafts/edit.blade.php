@extends('layouts.home')

@section('styles')

<link rel="stylesheet" href="{{ asset('css/uploadfiles.css') }}">
<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">

@endsection


@section('content')

<div class="w3-container">

</div>

<div class="w3-container" style="margin-top: 50px;">
    <div class="w3-row">

        <div class="w3-col l8">

            <!-- In response to -->

            <div class="w3-container w3-margin">
                @if($draft->responding_to > 0)
                <h6 class="px-4"> You're writing a response to: <a
                        href="{{ route('post.url', [$post->user->username, $post->url, $post->feed->id]) }}">
                        {{ $post->title }} </a> by <a href="{{ route('profile.show', $post->user->username) }}">
                        {{ $post->user->name }} </a> </h6>
                @endif
            </div>


            <!-- Publish form -->

            <div class="">
                <form id="draftForm" method="POST" action="{{ route('draft.update', $draft->id) }}"
                    enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <input type="hidden" name="responding_to" value="{{ $draft->responding_to }}">
                    <input id="cover_photo" type="hidden" name="cover_photo" value="">

                    <input id="method" type="hidden" name="_method" value="PUT">
                    <input id="d_method" type="hidden" name="draft_id" value="{{ $draft->id }}">

                    <input id="u_method" type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    @component('components.editor')
                    @slot('photo')
                    {{ old('photo_id') ?? $draft->photo_id }}
                    @endslot

                    @slot('category_id')
                    {{ old('category_id') ?? $draft->category_id}}
                    @endslot

                    @slot('category')
                    {{ $draft->category->name ?? '' }}
                    @endslot

                    @slot('title')
                    {{ old('title') ?? $draft->title}}
                    @endslot


                    <div id="image-preview-container" photo="{{ $draft->photo }}" class="mb-4"
                        style="position: relative; display: none;">
                        <img id="img_preview"
                            src="{{ $draft->photo ? '/images/' . $draft->user_id . '/' . $draft->photo->photo : '' }}"
                            alt="" class="postImage " width="100%" height="300px" style="object-fit: cover; ">
                        <div id="removeCoverImage"
                            style="cursor: pointer; position: absolute; top: 8px; right: 16px; font-size: 37px;"
                            class="top-right py-2 px-2">X</div>
                    </div>

                    @slot('body')
                    {{ old('body') ?? $draft->body }}
                    @endslot

                    @endcomponent


                    <div class="w3-container w3-right mt-4" style="display: none;">
                        <div class="w3-right">
                            <button id="save" type="submit" class="btn btn-primary" onclick="saveToDrafts()">
                                {{ __('Save') }}
                            </button>

                            <button id="publish" onclick="publishPost()" type="submit" class="btn btn-primary">
                                {{ __('Publish') }}
                            </button>
                        </div>
                    </div>



                </form>
                <span id="categoryUrl" url="{{ route('categories-create') }}" class="d-none"></span>
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
                    <button id="preClickSave" style="width: 100%" id="draftBtn" onclick="saveToDrafts()" type="submit" class="w3-padding">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>


            <div class="w3-containere w3-border w3-center w3-margin">
                @include('includes.addMedia')

            </div>

            <div class="">

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

<!-- <script src="{{ asset('js/app.js') }}"></script> -->
<!-- <script src="{{ asset('js/summernote-bs4.js') }}" defer></script> -->
<script src="{{ asset('js/preview-image.js') }}"></script>

<script>
$(document).ready(function() {
    $('#summernote').summernote({
        height: 300,
    });

});


function photosOverlay(element) {

    document.getElementById("photosOverlay").style.display = "block";
    document.getElementById("coverPhotoModal").style.display = "none";

}


function saveToDrafts() {
    var myForm = document.getElementById("draftForm");
    document.getElementById('title').removeAttribute('required');

    document.getElementsByTagName('textarea')[0].removeAttribute('required');
    // myForm.action = "/drafts/create";

}

function publishPost() {
    var myForm = document.getElementById("draftForm");
    var hiddenMethod = document.getElementById("method");
    hiddenMethod.value = "";
    myForm.action = "{{ route('write.store') }}";


}

function showCoverImage() {
    if (document.getElementById("image-preview-container").getAttribute("photo") == "") {
        document.getElementById("image-preview-container").style.display = "none"
    } else {
        document.getElementById("image-preview-container").style.display = "block"
    }


}

setTimeout(showCoverImage, 2000);


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
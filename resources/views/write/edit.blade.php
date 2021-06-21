@extends('layouts.write')

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


            <!-- Publish form -->


            <span id="create_post" post_route="{{ route('write.store') }}" class="d-none"></span>

            <div class="w3-hide-large w3-center">
            
                <button onclick="document.getElementById('coverPhotoModal').style.display='block'" class="w3-button">Add
                    A Cover
                    Picture</button>
            </div>


            <div class="">
                <form method="POST" action="{{ route('write.update', $post->id) }}" enctype="multipart/form-data"
                    class="mt-4">
                    @csrf

                    <input id="cover_photo" type="hidden" name="cover_photo" value="{{ $post->photo->photo ?? '' }}">
                    <input type="hidden" name="_method" value="PUT">

                    <input id="url" type="hidden" class="py-4 form-control @error('url') is-invalid @enderror"
                        name="url" value="{{ old('url') }}" autocomplete="url" autofocus>




                    <div class="w3-container">


                        <input type="hidden" name="inResponseTo" value="{{ $post_look_up->post_id ?? '' }}">
                        <input id="url" type="hidden" class="py-4 form-control @error('url') is-invalid @enderror"
                            name="url" value="{{ old('url') }}" autocomplete="url">

                        <input id="url" type="hidden" class="py-4 form-control @error('user_id') is-invalid @enderror"
                            name="user_id" value="{{ Auth::user()->id }}">

                    </div>

                    @component('components.editor')
                    @slot('photo')
                    {{ old('photo_id') }}
                    @endslot

                    @slot('category_id')
                    {{ $category->id ?? ''}}
                    @endslot

                    @slot('category')
                    {{ $category->name ?? ''}}
                    @endslot

                    @slot('title')
                    {{ old('title') ?? $post->title }}
                    @endslot

                    <div id="image-preview-container" photo="{{ $post->photo }}" class="mb-4"
                        style="position: relative; display: none;">
                        <img id="img_preview"
                            src="{{ $post->photo ? '/images/' . $post->user_id.'/' . $post->photo->photo : '' }}" alt=""
                            class="postImage " width="100%" height="300px" style="object-fit: cover; ">
                        <div id="removeCoverImage"
                            style="cursor: pointer; position: absolute; top: 8px; right: 16px; font-size: 37px;"
                            class="top-right py-2 px-2">X</div>
                    </div>

                    @slot('body')
                    {{ old('body') ?? $post->body }}
                    @endslot

                    @endcomponent



                    <div class="w3-container w3-right mt-4" style="display: none;">
                        <div class="w3-right">
                            <button id="publish" type="submit" class="btn btn-primary">
                                {{ __('Update Post') }}
                            </button>
                        </div>
                    </div>


                </form>

            </div>

        </div>

        <div class="w3-col l4">
            <div class="w3-hide-small" style="margin-top: 100px;"></div>
            <div class="w3-container">
                <div class="w3-center">
                    <button id="preClickPublish" style="width: 100%" type="submit" class="w3-padding">
                        {{ __('Update') }}
                    </button>
                </div>
                <!-- <div class="w3-half w3-center">
                    <button id="preClickSave" style="width: 100%" type="submit" class="w3-padding">
                        {{ __('Save') }}
                    </button> 
            </div> -->
            </div>

            <div class="w3-containere w3-border w3-center w3-margin w3-hide-small">
                <button onclick="document.getElementById('coverPhotoModal').style.display='block'" class="w3-button">Add
                    A Cover
                    Picture</button>
            </div>

            <div class="w3-container w3-margin w3-center w3-border writing-options-item w3-hide-small">
                <button class="w3-button my-categories-button">Select Category</button>
            </div>


            <div class="my-categories mb-4 w3-hide-small" style="display: none;" >
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
@include('includes.addMedia')

@endsection

@section('scripts')


<script>



function showCoverImage() {
    if (document.getElementById("image-preview-container").getAttribute("photo") == "") {
        document.getElementById("image-preview-container").style.display = "none"
    } else {
        document.getElementById("image-preview-container").style.display = "block"

    }
    document.getElementById("editorComponent").style.display = "block"

}

setTimeout(showCoverImage, 2000);

</script>
@endsection
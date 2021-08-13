@extends('layouts.write')

@section('styles')

<link rel="stylesheet" href="{{ asset('css/uploadfiles.css') }}">

@endsection


@section('content')
@include('includes.loadBlock')
<div class="w3-container" id="wrapper-div" style="display: none;">

</div>

<div class="w3-container" style="margin-top: 50px;">
    <div class="w3-row">

        <div class="w3-col l8">

            <!-- In response to -->

            <div class="w3-container">
                @if($feed)
                @if($feed->post)
                <h6 class="px-4"> You're writing a response to: <a
                        href="{{ route('post.url', [$feed->user->username, $feed->post->url, $feed->id]) }}">
                        {{ $feed->post->title }} </a> by <a href="{{ route('profile.show', $feed->user->username) }}">
                        {{ $feed->post->user->name }} </a> </h6>
                @endif
                @endif
            </div>

            <div class="w3-hide-large w3-center">
            
                <button onclick="document.getElementById('coverPhotoModal').style.display='block'" class="w3-button">Add
                    A Cover
                    Picture</button>

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
                        @if($feed->post)
                        <input type="hidden" name="responding_to" value="{{ $feed->post->id }}">
                        @endif
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
            <div style="margin-top: 100px;" class="w3-hide-small"></div>
            <div class="w3-container">
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

            <div class="w3-containere w3-border w3-center w3-margin w3-hide-small">
                <button onclick="document.getElementById('coverPhotoModal').style.display='block'" class="w3-button">Add
                    A Cover
                    Picture</button>

            </div>

            <!-- <div class="w3-container w3-margin w3-center w3-border writing-options-item w3-hide-small">
                <button class="w3-button my-categories-button">Select Category</button>
            </div> -->


            <!-- <div class="my-categories mb-4" style="display: none;">
                <div class="w3-right my-2">
                    <button class="my-categories-close-button w3-button">Close
                    </button>
                </div>
                <div class="py-4">
                    
                </div>
            </div> -->



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
<script src="{{ asset('js/loadBlock.js') }}"></script>

@endsection
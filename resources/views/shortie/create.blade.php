<!DOCTYPE html>

<html>

<head>

    <title>Shortie - Create</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('css/w3-css.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shortie.css') }}" rel="stylesheet">

    <link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet">


    <style type="text/css">

    </style>


</head>

<body>

    <header class="w3-container w3-top w3-xlarge " style="background-color: #212121">
        <span class="w3-left w3-padding w3-text-white"><b>typesicle</b></span>

        <a href="javascript:void(0)" class="w3-hide-large w3-hide-medium w3-right w3-button w3-white"
            onclick="w3_open()">☰</a>
        <!-- <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open_right_menu()">☰</a> -->

        @guest
        <a class="w3-right w3-button w3-white" href="{{ route('login') }}">{{ __('Login') }}</a>
        @if (Route::has('register'))
        <a class="w3-right w3-button w3-white" href="{{ route('register') }}">{{ __('Register') }}</a>
        @endif
        @endguest
    </header>



    <div class="w3-container" style="margin-top: 50px;" >
        <div class="row justify-content-center">
            <div class="w3-col l6">


                <form id="myShorties" action="{{ route('store:shortie') }}" method="post" enctype="multipart/form-data" style="margin-top: 100px;">
                    @csrf
                    <input id="count" type="hidden" name="count">
                    <input id="isEmpty" type="hidden" name="isEmpty" value="No">

                    @if($shortie)
                    <input type="hidden" name="quoted" value="{{ $shortie->id }}">
                    @endif

                    <div class="w3-container">

                        <div class="w3-container shortie-container w3-border mb-4">
                            <div class="w3-container">
                                <textarea id="shortie" style="font-size: 21px; width: 100%; resize: none;"
                                    class="py-2 px-2 shortie summernote" placeholder="Wata Guan?"></textarea>
                                <div style="display: none;" class="w3-container py-4 imageLimitError">You cannot upload
                                    more than four images</div>
                            </div>

                            <div class="w3-container my-4 media "></div>

                            <div class="w3-container my-4 shortie-option">
                                <div class="w3-twothird">

                                    <!-- Upload Image button -->

                                    <input type="button" id="uploadButton" class="uploadButton w3-button"
                                        value="Upload Image">
                                    <div class="inputButton">
                                        <input identify="uploadFile1" type="file" class="uploadFile1 fileUpload"
                                            style="display: none;" multiple />
                                        <input identify="uploadFile2" type="file" class="uploadFile2 fileUpload"
                                            style="display: none;" multiple />
                                        <input identify="uploadFile3" type="file" class="uploadFile3 fileUpload"
                                            style="display: none;" multiple />
                                        <input identify="uploadFile4" type="file" class="uploadFile4 fileUpload"
                                            style="display: none;" multiple />

                                    </div>

                                    <div class="toBeRemoved"></div>
                                    <div class="counts">
                                        <input class="uploadFile1 count1 skipCount" type="hidden" value="0" />
                                        <input class="uploadFile2 count2 skipCount" type="hidden" value="0" />
                                        <input class="uploadFile3 count3 skipCount" type="hidden" value="0" />
                                        <input class="uploadFile4 count4 skipCount" type="hidden" value="0" />
                                    </div>

                                </div>

                                <div class="w3-third">
                                    <!-- <button style="font-size: 22px;"
                                    class="py-2 px-3 w3-right w3-circle add-shortie">+</button> -->
                                    <span class="chars">750</span>
                                    <!-- <input type="button" style="font-size: 22px;"
                                        class="py-2 px-3 w3-right w3-circle add-shortie" value="+"> -->

                                </div>
                            </div>
                        </div>

                        <input id="postButton" type="submit" class="w3-button" name='submitImage' value="Post"
                            style="display: none" />

                    </div>

                </form>
                <div class="w3-container w3-center">
                    <button class="w3-padding send"> Publish </button>
                </div>
                <!-- <button class="share"> Without comment </button> -->


                <div class="w3-container" style="display: none;">
                    <div class="w3-container w3-border">
                        <button id="clickPostButton" class="w3-button">Post</button>
                    </div>
                </div>
                <br />


                @if($shortie)
                <div id="app">
                    <header-component username="{{ $shortie->user->username }}" user-id="{{ $shortie->user_id }}"
                        name="{{ $shortie->user->name }}"
                        photo="/images/{{ $shortie->user->id }}/profile_pic/{{ $shortie->user->profile->picture }}"
                        date="{{ $shortie->created_at->toFormattedDateString() }}" size="width: 35px">
                    </header-component>

                    <shortie-component shortie-id="{{ $shortie->id }}" user-id="{{ Auth::user()->id }}"
                        shortie="{{ json_encode($shortie) }}"
                        route="{{ route('shortie.url', [$shortie->user->username, $shortie->feed->id])  }}"
                        height="{{ count($shortie->shortiePhoto) == 1 ? '500px' : '250px' }}"
                        smallscreen-height="{{ count($shortie->shortiePhoto) == 1 ? '300px' : '150px' }}">
                        {!! $shortie->shortie !!}
                    </shortie-component>

                    @if($shortie->quoted > 0)
                    <div class="mb-4 w3-margin-top  w3-border" style="width: 80%; margin: auto;">

                        <header-component username="{{ $shortie->quoted($shortie->quoted)->user->username }}"
                            user-id="{{ $shortie->quoted($shortie->quoted)->user->id }}"
                            name="{{ $shortie->quoted($shortie->quoted)->user->name }}"
                            photo="/images/{{$shortie->quoted($shortie->quoted)->user->id}}/profile_pic/{{$shortie->quoted($shortie->quoted())->user->profile->picture }}"
                            date="{{ $shortie->quoted($shortie->quoted)->created_at->toFormattedDateString() }}"
                            size="width: 15px" fontsize="font-size: 11px;">
                        </header-component>

                        <shortie-component shortie-id="{{ $shortie->quoted($shortie->quoted)->id }}"
                            user-id="{{ Auth::user()->id }}"
                            shortie="{{ json_encode($shortie->quoted($shortie->quoted)) }}"
                            route="{{ route('shortie.url', [$shortie->quoted($shortie->quoted)->user->username, $shortie->quoted($shortie->quoted)->feed->id])  }}"
                            height="{{ count( $shortie->quoted($shortie->quoted)->shortiePhoto) == 1 ? '450px' : '200px' }}"
                            smallscreen-height="{{ count($shortie->quoted($shortie->quoted)->shortiePhoto) == 1 ? '250px' : '100px' }}">
                            {!! $shortie->quoted($shortie->quoted)->shortie !!}
                        </shortie-component>
                    </div>
                    @endif

                </div>
                @endif

            </div>



        </div>


    </div>

    @component('components.errorModal')
    <div class="w3-container">
        <p>Please, upload an image.</p>
        <p>The formats supported are GIF, PNG & JPG. :)</p>
    </div>
    @endcomponent




    <!-- <script src="{{ asset('js/autosize.min.js') }}"></script>
    <script>
    autosize(document.querySelectorAll('textarea'));
    // autosize($('textarea'));
    </script> -->
</body>
<script src="{{ asset('js/summernote-bs4.js') }}" defer></script>
<script>
$(document).ready(function() {
    $(".send").attr("disabled", true);
    var maxLength = 750;

    $('.summernote').summernote({
        toolbar: [],
        placeholder: "What's on your mind?",

        callbacks: {
            onInit: function() {
                $(".note-editable").on('click', function(e) {
                    // alert('clicked');
                    $(this).parents(".shortie-container").find(".shortie-option").css(
                        "display", "block")
                    $(this).parents(".shortie-container").siblings().find(".shortie-option")
                        .css("display", "none")
                });
            },
            onKeyup: function(e) {
                // alert('Key is released: ' + e.keyCode);

                var length = $(this)
                    .summernote("code")
                    .replace(/<\/p>/gi, "\n")
                    .replace(/<br\/?>/gi, "\n")
                    .replace(/<\/?[^>]+(>|$)/g, "")
                    .trim().length;

                var length = maxLength - length;
                $(this).parents(".shortie-container").find(".chars").text(length)

                if (length < 750 && length > 0) {
                    $(".send").attr("disabled", false);
                } else {
                    $(".send").attr("disabled", true);
                }

            },
        },
    });
});
</script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/create-shortie.js') }}" defer></script>
<script>
$(document).ready(function() {

    $(".share").click(function() {
        $("#myShorties").attr("action", "/w/o/shortie");
        $("#postButton").click();

    });


});


var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<script src="{{ asset('js/shortie.js') }}" defer></script>
<!-- <script src="{{ asset('js/create-shortie.js') }}" defer></script> -->

</html>
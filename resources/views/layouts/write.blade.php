<!DOCTYPE html>
<html>
<title>{{ $page_name ?? '' }}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">


<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{ asset('css/w3-css.css') }}" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>


<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="{{ asset('js/summernote-bs4.js') }}" defer></script>


<!-- <link rel="stylesheet" href="{{ asset('css/dropdownpreview.css') }}">      -->
@yield('styles')

<style>
html,
body,
h1,
h2,
h3,
h4,
h5 {
    font-family: "Raleway", sans-serif
}

a {
    text-decoration: none
}
</style>

<body class="w3-light-grey">
    <div id="app">

        <!-- Top container  -->

        <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
        
            <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey"
                onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
            <span class="w3-bar-item w3-right">Logo</span>
        </div>



        <main>
                @yield('content')

                
        </main>


    </div>
</body>

</html>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')

<!-- <script src="{{ asset('js/summernote-bs4.js') }}" defer></script> -->

<script>
// function loadPage() {
    // document.getElementById("editor").style.display = "block"
    // document.getElementById("loading").style.display = "none";
    // document.getElementById("writing-options").style.display = "block"
// }

// setInterval(() => {
//     loadPage();
// }, 1500);

$(document).ready(function() {
    $('.my-categories-button').click(function() {
        $(".my-categories").css("display", "block");
        $(".writing-options-item").css("display", "none");

    });

    $('.my-categories-close-button').click(function() {
        $(".my-categories").css("display", "none");
        $(".writing-options-item").css("display", "block");
                
    });

});

$(document).ready(function() {

$('#addCoverImage').click(function() {
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
    // $('.postImage').remove();
    // $(this).css("display", "none");
    $("#image-preview-container").css("display", "none");
    $("#upload_pic").val("");
    $('#cover_photo').val("");

});
if ($("#img_preview").attr("src") == "") {
    $("#image-preview-container").css("display", "none");
}

});

</script>


<script>
$(document).keydown(function(event) {
    if (event.keyCode == 27) {
        // $('#modal01').hide();
        $('.sendDraftModal').hide();
        $('.w3-modal').hide();
        // $(".useername").load(location.href + ".username");

        $(".username").siblings().css("display", "block");
        $(".username").find(".draftOptions, .draftComment").css("display", "none");


    }
});


</script>
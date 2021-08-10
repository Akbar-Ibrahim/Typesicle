<!DOCTYPE html>
<html lang="en">
<title>Typesicle Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="{{ asset('css/w3-css.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- <link href="{{ asset('css/w3-css.css') }}" rel="stylesheet"> -->


<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>




<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">





<style>
body,
h1,
h2,
h3,
h4,
h5 {
    font-family: "Raleway", sans-serif
}

.w3-quarter img {
    margin-bottom: -6px;
    cursor: pointer
}

.w3-quarter img:hover {
    opacity: 0.6;
    transition: 0.3s
}

/* Overlay */

.overlay {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0, 0.9);
  overflow-x: hidden;
  transition: 0.5s;
}

.overlay-content {
  position: relative;
  top: 5%;
  width: 100%;
  text-align: center;
  margin-top: 30px;
}

.overlay a {
  padding: 8px;
  text-decoration: none;
  font-size: 36px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.overlay a:hover, .overlay a:focus {
  color: #f1f1f1;
}

.overlay .closebtn {
  position: absolute;
  top: 2px;
  right: 45px;
  font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlay a {font-size: 20px}
  .overlay .closebtn {
  font-size: 40px;
  top: 15px;
  right: 35px;
  }
}

</style>

@yield('styles')

<body class="w3-light-grey">
<div id="app">
    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-bar-block w3-animate-right w3-top w3-text-light-grey w3-large"
        style="z-index:3;width:450px;font-weight:bold;display:none;right:0;background-color: #212121" id="mySidebar">
        <a href="javascript:void()" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-32 w3-text-white">CLOSE</a>
        <div style="height: 640px; overflow: scroll" class="">
        <createcategory-component username="{{ Auth::user()->username }}"></createcategory-component>
        </div>
    </nav>

    <!-- Top menu on small screens -->
    <header class="w3-container w3-top w3-xlarge " style="background-color: #212121">
        <span class="w3-left w3-padding w3-text-white"><b>typesicle</b></span>
        @if ($route))
        @else
        <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open()">☰</a>
        @endif
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu"
        id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main w3-content " style="max-width:1400px;margin-top:83px">

        <!-- Photo grid -->
        <div class="w3-row w3-grayscale-min" id="app">
                

            <main>
                @yield('content')
            </main>
        </div>
        <!-- End page content -->
    </div>



    @component('components.errorModal')
    <div class="w3-container">
        <p>Please, upload an image.</p>
        <p>The formats supported are GIF, PNG & JPG. :)</p>
    </div>
    @endcomponent

    @include('includes.coverPhoto')





    
</div>

<script>
function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}



    // Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }

    // Modal Image Gallery
    function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
        var captionText = document.getElementById("caption");
        captionText.innerHTML = element.alt;
    }
    </script>


</body>

</html>
<script src="{{ asset('js/app.js') }}"></script>
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

function delayEditorLoad() {

    document.getElementById("editorComponent").style.display = "block"

}

setTimeout(delayEditorLoad, 1500);


$(document).ready(function() {

    $(document).keydown(function(event) {
    if (event.keyCode == 27) {
        $('#mySidebar').hide();
        $('#myOverlay').hide();
    }
    });
    

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

@yield('scripts')
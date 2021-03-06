<!DOCTYPE html>
<html lang="en">
<title>Typesicle Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<link href="{{ asset('css/w3-css.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
</style>
@yield('styles')

<body class="w3-light-grey">

    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-bar-block w3-animate-right w3-top w3-text-white w3-large w3-hide-large"
        style="z-index:3;width:250px;font-weight:bold;display:none;right:0;background-color:#212121;" id="myRightSidebar">
        <a style="text-decoration: none; background-color: #212121;" href="javascript:void()" onclick="w3_close_right_menu()" class="w3-bar-item w3-button w3-center w3-padding-32 my-side">CLOSE</a>
        <a style="text-decoration: none; background-color: #212121;" href="/" class="w3-bar-item w3-button w3-center w3-padding-16" my-side>BACK TO TYPESICLE</a>
        <a style="text-decoration: none; background-color: #212121;" href="/register" class="w3-bar-item w3-button w3-center w3-padding-16 my-side">SIGN UP</a>
        <a style="text-decoration: none; background-color: #212121;" href="/login" class="w3-bar-item w3-button w3-center w3-padding-16 my-side">SIGN IN</a>
        
    </nav>

    <!-- Top menu on small screens -->
    <header class="w3-container w3-top w3-large " style="background-color: #212121">
        <a href="/"><span class="w3-left w3-padding w3-text-white"><b>Typesicle</b></span></a>
        <!-- <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open()">???</a> -->

        @guest
        <a style="text-decoration: none;" class="w3-right w3-button w3-text-white w3-hide-small auth-links" href="{{ route('login') }}">{{ __('SIGN IN') }}</a>
        @if (Route::has('register'))
        <a style="text-decoration: none;" class="w3-right w3-button w3-text-white w3-hide-small auth-links" href="{{ route('register') }}">{{ __('SIGN UP') }}</a>
        @endif
        @endguest
        <a style="background-color: #212121;" href="javascript:void(0)" class="w3-right w3-button w3-text-white w3-hide-large" onclick="w3_open_right_menu()">???</a>
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu"
        id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main w3-content " style="max-width:1400px;margin-top:83px">

        <!-- Photo grid -->
        <div class="w3-row w3-grayscale-min" id="app">

            <div class="w3-container" style="margin-top: 50px;">
                <main>
                    @yield('content')
                </main>
            </div>

        </div>



        <!-- End page content -->
    </div>

    <script>
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


    function w3_open_right_menu() {
        document.getElementById("myRightSidebar").style.display = "block";
        document.getElementById("myRightOverlay").style.display = "block";
    }

    function w3_close_right_menu() {
        document.getElementById("myRightSidebar").style.display = "none";
        document.getElementById("myRightOverlay").style.display = "none";
    }
    
    $(document).ready(function() {
        $(".my-side").click(function() {
        $(this).css("background-color", "#363636")
    });

    $(".my-side").mouseover(function() {
        $(this).css("background-color", "#363636")
    });

    $(".my-side").mouseout(function() {
        $(this).css("background-color", "#212121")
    });

    $(".auth-links").click(function() {
        $(this).css("background-color", "#363636")
    });

    $(".auth-links").mouseover(function() {
        $(this).css("background-color", "#363636")
    });

    $(".auth-links").mouseout(function() {
        $(this).css("background-color", "#212121")
    });
});

    $(document).ready(function() {
    $(document).keydown(function(event) {
    if (event.keyCode == 27) {
        $("#myRightSidebar").hide();

    }
    });
    });
    </script>


</body>

</html>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
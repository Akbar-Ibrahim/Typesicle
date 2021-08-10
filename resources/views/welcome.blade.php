<!DOCTYPE html>
<html lang="en">
<title>Typesicle Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/w3-css.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
body,
h1,
h2,
h3,
h4,
h5 {
    font-family: "Raleway", sans-serif
}


#hashtags {
    overflow: hidden;
}

.sticky {
    position: fixed;
    top: 0;
    width: 100%;
}
</style>

<body class="w3-light-grey">

    <!-- Sidebar/menu -->
    <!-- <nav class="w3-sidebar w3-bar-block w3-black w3-animate-right w3-top w3-text-light-grey w3-large"
        style="z-index:3;width:250px;font-weight:bold;display:none;right:0;" id="mySidebar">
        <a href="javascript:void()" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-32">CLOSE</a>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-16">PORTFOLIO</a>
        <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-16">ABOUT ME</a>
        <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-16">CONTACT</a>
    </nav> -->

    <!-- Top menu on small screens -->
    <header class="w3-container w3-top w3-white w3-xlarge w3-padding-16">
        <span class="w3-left w3-padding">typesicle</span>
        <!-- <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open()">☰</a> -->

        @guest
        <a class="w3-right w3-button w3-white" href="{{ route('login') }}">{{ __('Login') }}</a>
        @if (Route::has('register'))
        <a class="w3-right w3-button w3-white" href="{{ route('register') }}">{{ __('Register') }}</a>
        @endif
        @endguest
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu"
        id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main w3-content " style="max-width:1400px;margin-top:83px">



@include('includes.about')


        <!-- Photo grid -->
        <div class="w3-row w3-grayscale-min" id="app">

            <div class="w3-container w3-padding" style="max-width: 700px; margin: auto;">
                <postsearch-component></postsearch-component>
            </div>

            <div class="" style="max-width: 800px; margin: auto; ">
                <div class="w3-container " style="margin-top: 50px;">
                    @if($feeds)
                    <home-component posts="{{ $feeds }}" user-id="0" user="{{ json_encode($user) }}" user-type="guest">
                    </home-component>
                    @else
                    <div class="w3-container w3-center">
                        <h2> Nothing to see here :) </h2>
                    </div>
                    @endif
                </div>
            </div>

            


        </div>






        <!-- Footer -->
        <footer class="w3-container w3-padding-32 w3-grey">


        </footer>



        <!-- End page content -->
    </div>

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
<!DOCTYPE html>
<html>
<title>Typesicle | Home</title>
<meta charset="UTF-8">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<link href="{{ asset('css/w3-css.css') }}" rel="stylesheet"> -->


<meta name="csrf-token" content="{{ csrf_token() }}">


<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script> -->

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/search-user.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">



<link href="{{ asset('css/w3-css.css') }}" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



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
</style>
@yield('styles')

<body class="w3-light-grey">
    <div style="margin-top: 200px;" id="loadBlockWrapper">
        @include('includes.loadBlock')
    </div>
    <div id="wrapper-div" style="display: none;">
        @auth
        <span id="authid">{{ Auth::user()->id }}</span>
        @endauth

        <!-- Top container -->
        <div class="w3-bar w3-top w3-large" style="z-index:4; background-color: #212121">
            <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-text-white" style="background-color: #212121"
                onclick="w3_open();"><i class="fa fa-bars w3-text-white"></i> </button>
            <a href="/"><span class="w3-bar-item w3-text-white">Typesicle</span></a>
            <div class="w3-right">
                @guest
                <a class="w3-right w3-button w3-text-white w3-hide-small" href="{{ route('login') }}">{{ __('SIGN IN') }}</a>
                @if (Route::has('register'))
                <!-- <a class="w3-right w3-button w3-text-white" href="{{ route('register') }}">{{ __('Register') }}</a> -->
                @endif
                @endguest
                <!-- <span class="w3-bar-item w3-right">SIGN IN</span> -->
            </div>


            @if(Auth::user() && Auth::user()->role === "admin")
            <a href="javascript:void(0)" class="w3-right w3-button w3-text-white" onclick="w3_open_right_menu()">☰</a>
            @endif
            @auth
            <button route="{{ route('notification.index') }}" onclick="location.href=this.getAttribute('route')"
                class="w3-button w3-padding w3-right " title="Notifications"><i style="background-color: #7CFC00;"
                    class="fa fa-bell"></i><span style="display: none;" id="newNotification"
                    class="w3-badge w3-right w3-small w3-red"> {{ count($n) }}
                </span></button>
            @endauth
        </div>


        <!-- Admin Sidebar/menu -->
        <nav class="w3-sidebar w3-bar-block  w3-animate-right w3-top w3-text-white w3-large"
            style="z-index:13;width:250px;font-weight:bold;display:none;right:0;background-color:#212121"
            id="myRightSidebar">
            <a href="javascript:void()" onclick="w3_close_right_menu()"
                class="w3-bar-item w3-button w3-center w3-padding-32">CLOSE</a>
            <a href="{{ route('admin.index') }}" onclick="w3_close()"
                class="w3-bar-item w3-button w3-center w3-padding-16">Admin</a>
            <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-16">ABOUT ME</a>
            <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-16">CONTACT</a>
        </nav>


        <!-- Sidebar/menu -->
        @guest
        @include('includes.guestSidebar')
        @else
        @include('includes.authSidebar')
        @endauth


        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer"
            title="close side menu" id="myOverlay"></div>

        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:300px;margin-top:43px;">



            <main>
                <div id="app">
                    @include('includes.searchUser')


                    <div class="w3-main">


                        <!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
                        <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top"
                            style="margin-top:46px; z-index: 6">
                            <!-- menu goes here -->
                        </div>

                        @yield('content')


                        @auth
                        @if(1)
                        <!-- Footer -->
                        <footer class="w3-container w3-padding-16 w3-light-grey w3-bottom w3-hide-large">

                            <div class="w3-row-padding d-flex">
                                <!-- <div class="w3-col s3 w3-center ">
                            <span style="cursor: pointer;" onclick="postOverlay(this)">Posts</span>
                        </div> -->
                                <div class="w3-center flex-fill">
                                    <span style="cursor: pointer;" onclick="location.href='/home'">Home</span>
                                </div>
                                <div class=" w3-center flex-fill">
                                    <span style="cursor: pointer;" onclick="categoryOverlay(this)">Categories</span>
                                </div>
                                <div class="w3-center flex-fill">
                                    <span style="cursor: pointer;" onclick="photoOverlay(this)">Photos</span>
                                </div>
                            </div>
                        </footer>
                        @include('includes.smallScreenOverlay')

                        @endif
                        @endauth

                    </div>
                </div>
            </main>




            <!-- End page content -->
        </div>

        <script>
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Get the DIV with overlay effect
        var overlayBg = document.getElementById("myOverlay");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
                overlayBg.style.display = "none";
            } else {
                mySidebar.style.display = 'block';
                overlayBg.style.display = "block";
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }

        function w3_open_right_menu() {
            document.getElementById("myRightSidebar").style.display = "block";
            document.getElementById("myRightOverlay").style.display = "block";
        }

        function w3_close_right_menu() {
            document.getElementById("myRightSidebar").style.display = "none";
            document.getElementById("myRightOverlay").style.display = "none";
        }
        </script>




    </div>
</body>

</html>
<script src="{{ asset('js/app.js') }}"></script>
<!-- <script src="{{ asset('js/summernote-bs4.js') }}" defer></script> -->
<script src="{{ asset('js/smallScreenOverlay.js') }}" defer></script>


<script>
$(document).ready(function() {
    $(".menu-links").mouseover(function() {
        $(this).css("background-color", "#363636")
    });

    $(".menu-links").mouseout(function() {
        $(this).css("background-color", "#212121")

    });
});

function openSearch() {
    document.getElementById("searchUserOverlay").style.display = "block";
}

function closeSearch() {
    document.getElementById("searchUserOverlay").style.display = "none";
}

$(document).keydown(function(event) {
    if (event.keyCode == 27) {
        $("#myRightSidebar").hide();
        $('.w3-modal').hide();
        $('#mySidebar').hide();
        $('#navDemo').hide();
        $("#closeMenu").click();
        $("#searchUserOverlay").hide();

    }
});

var authid = document.getElementById("authid").textContent;
var noti = document.getElementById("newNotification").textContent;

if (document.getElementById("newNotification").textContent > 0) {

    document.getElementById("newNotification").style.display = "inline-block";
}

Echo.private("notification-channel").listen("NotificationEvent", (event) => {

    if (event.user_id == authid) {
        document.getElementById("newNotification").style.display = "inline-block";
        document.getElementById("newNotification").innerHTML = event.count;
    }


});
</script>
<script src="{{ asset('js/loadBlock.js') }}"></script>
@yield('scripts')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>W3.CSS Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
        font-family: "RobotoDraft", "Roboto", sans-serif
    }

    .w3-bar-block .w3-bar-item {
        padding: 16px;
        text-decoration: none;
    }
    </style>
    @yield('styles')

</head>


<body>
    @auth
    <span id="authid">{{ Auth::user()->id }}</span>
    @endauth

    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-bar-block  w3-animate-right w3-top w3-text-white w3-large"
        style="z-index:3;width:250px;font-weight:bold;display:none;right:0;background-color:#212121" id="myRightSidebar">
        <a href="javascript:void()" onclick="w3_close_right_menu()"
            class="w3-bar-item w3-button w3-center w3-padding-32">CLOSE</a>
        <a href="{{ route('admin.index') }}" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-16">Admin</a>
        <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-16">ABOUT ME</a>
        <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-16">CONTACT</a>
    </nav>


    <header class="w3-container w3-top w3-xlarge " style="background-color: #212121;z-index:10">
        <span class="w3-left w3-padding w3-text-white"><b>typesicle</b></span>
        
        <a href="javascript:void(0)" class="w3-hide-large w3-hide-medium w3-right w3-button w3-white" onclick="w3_open()">☰</a>
        @if(Auth::user() && Auth::user()->role === "admin")
        <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open_right_menu()">☰</a>
        @endif
        @auth
        <button route="{{ route('notification.index') }}" onclick="location.href=this.getAttribute('route')"
            class="w3-button w3-padding-large w3-right " title="Notifications"><i class="fa fa-bell w3-green"></i><span
                style="display: none;" id="newNotification" class="w3-badge w3-right w3-small w3-red"> {{ count($n) }}
            </span></button>
        @endauth


        @guest
        <a class="w3-right w3-button w3-white" href="{{ route('login') }}">{{ __('Login') }}</a>
        @if (Route::has('register'))
        <a class="w3-right w3-button w3-white" href="{{ route('register') }}">{{ __('Register') }}</a>
        @endif
        @endguest
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu"
        id="myRightOverlay"></div>

    <!-- Side Navigation -->
    <nav class="w3-sidebar w3-bar-block w3-collapse w3-text-white w3-animate-left w3-card"
        style="z-index:3;width:300px; margin-top: 46px; background-color: #212121" id="mySidebar">
        @guest
      <div class="">  
        <div class="w3-hide-large w3-text-white">
                    <a href="javascript:void(0)"  style="font-size: 30px; text-decoration: none;" class="w3-margin w3-padding w3-text-white" onclick="w3_close()">Close</a>
                </div>
        <a href="/" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home fa-fw"></i>
            Home</a>
        <a href="{{ route('top-pages') }}" class="w3-bar-item w3-button w3-padding w3-text-white"><i class="fa fa-map fa-fw"></i> Top
            Pages</a>
        <a href="{{ route('discover') }}" class="w3-bar-item w3-button w3-padding w3-text-white"><i class="fa fa-cc-discover fa-fw"></i> Discover</a>
        <a href="{{ route('popular') }}" class="w3-bar-item w3-button w3-padding w3-text-white"><i class="fa fa-cc-discover fa-fw"></i> Popular on Typesicle</a>
        <a href="{{ route('category.index') }}" class="w3-bar-item w3-button w3-padding w3-text-white"><i
                class="fa fa-list fa-fw"></i> See Categories</a>
</div>
        @else
        <div class="w3-container w3-padding w3-margin-top" style="background-color: #212121">
            <div class="d-flex w3-padding-top" style="background-color: #212121">
                <div style="background-color: #212121">
                    @if(Auth::user()->profile->picture === 'avatar.png')
                    <img src="/images/avatar.png" class="w3-circle w3-margin-right w3-border"
                        style="width:30px; height:30px;">
                    @else
                    <img src="/images/{{ Auth::user()->id }}/profile_pic/{{ Auth::user()->profile->picture }}"
                        class="w3-circle w3-margin-right w3-border" style="width:30px; height:30px;">
                    @endif
                </div>
                <div class="flex-grow-1">
                    <a class="w3-text-white" href="{{ route('profile.show', Auth::user()->username) }}"> {{ Auth::user()->name }} </a>
                </div>
                <div class="w3-hide-large w3-text-white">
                    <a href="javascript:void(0)"  style="font-size: 30px;" onclick="w3_close()">X</a>
                </div>
            </div>
        </div>
        <div class="w3-container">
            <button id="edit-profile"
                edit_profile="{{ route('profile.edit', [Auth::user()->username, Auth::user()->id]) }}"
                onclick="location.href=this.getAttribute('edit_profile')" style="font-size: 12px;"
                class="w3-button">Edit Profile</button>


            <!-- <a href="javascript:void(0)" class="w3-button w3-dark-grey w3-button w3-hover-black w3-left-align"
                onclick="document.getElementById('id01').style.display='block'">
                <span class="glyphicon glyphicon-search"></span>
                <sean>
            </a> -->

            <button class="w3-button openSearchBtn" onclick="openSearch()"><span
                    class="glyphicon glyphicon-search"></span></button>

            <a href="#" class="3-button w3-dark-grey w3-button w3-hover-black w3-left-align" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>

        <hr>
        <a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" id="closeMenu"
            class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>

        <a href="{{ route('home') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home fa-fw"></i>
            Home</a>

        
        <!-- <a href="{{ route('chat.with', Auth::user()->username) }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home fa-fw"></i> Messages -->
        </a>
        


        <a href="{{ route('write.index') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-pencil fa-fw"></i>
            Write</a>
        <!-- <a class="w3-bar-item w3-button w3-padding" href="/chatify"> <i class="fa fas fa-envelope"></i> message</a> -->
        <!-- <a href="{{ route('shortie-create') }}" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-pencil fa-fw"></i> Shortie</a> -->
        <a href="{{ route('draft.index') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-pencil fa-fw"></i>
            Drafts</a>
            <a href="{{ route('popular') }}" class="w3-bar-item w3-button w3-padding w3-text-white"><i class="fa fa-cc-discover fa-fw"></i> Popular on Typesicle</a>
        <!-- <a href="{{ route('photos.index', Auth::user()->username) }}" class="w3-bar-item w3-button w3-padding"><i class="fa fas fa-image"></i> My Photos</a> -->

        <a href="{{ route('history.index', Auth::user()->username) }}" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-history fa-fw"></i> History</a>
        <a href="{{ route('queue.index') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list fa-fw"></i>
            Queued Posts</a>
        <a href="{{ route('category.index') }}" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-list fa-fw"></i> Categories</a>
        <!-- <a href="{{ route('quizzes', $user->username) }}" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-list fa-fw"></i> My Quizzes</a> -->
        <a href="{{ route('profile.show', Auth::user()->username) }}" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-user fa-fw"></i> Profile</a><br><br>
        <br><br>


        @endauth
    </nav>


    <!-- Overlay effect when opening the side navigation on small screens -->

    <main>
        <div id="app" style="margin-top: 105px;">
            @include('includes.searchUser')


            <!-- Page content -->
            <div class="w3-main" style="margin-left:320px;">


                <!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
                <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top"
                    style="margin-top:46px; z-index: 6">
                    <!-- menu goes here -->
                </div>

                @yield('content')


                @auth
                @if(!\Request::is('home'))
                <!-- Footer -->
                <footer class="w3-container w3-padding-16 w3-light-grey w3-bottom w3-hide-large">

                    <div class="w3-row">
                        <div class="w3-col s3 w3-center ">
                            <span style="cursor: pointer;" onclick="postOverlay(this)">Posts</span>
                            <!-- <span style="cursor:pointer" onclick="openPostOverlay()">Posts</span> -->
                        </div>
                        <div class="w3-col s3 w3-center ">
                            <span style="cursor: pointer;" onclick="categoryOverlay(this)">Categories</span>
                            <!-- <span style="cursor:pointer" onclick="openCategoryOverlay()">Categories</span> -->
                        </div>
                        <div class="w3-col s3 w3-center ">
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

    <script>
    function dropmenu_small() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }


    function w3_open_right_menu() {
        document.getElementById("myRightSidebar").style.display = "block";
        document.getElementById("myRightOverlay").style.display = "block";
    }

    function w3_close_right_menu() {
        document.getElementById("myRightSidebar").style.display = "none";
        document.getElementById("myRightOverlay").style.display = "none";
    }

    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }
    </script>



    <script src="{{ asset('js/summernote-bs4.js') }}" defer></script>
</body>

</html>
<script src="{{ asset('js/app.js') }}"></script>
<!-- <script src="{{ asset('js/summernote-bs4.js') }}" defer></script> -->
<script src="{{ asset('js/smallScreenOverlay.js') }}" defer></script>


<script>
function openSearch() {
    document.getElementById("searchUserOverlay").style.display = "block";
}

function closeSearch() {
    document.getElementById("searchUserOverlay").style.display = "none";
}

$(document).keydown(function(event) {
    if (event.keyCode == 27) {
        $('.w3-modal').hide();
        // $('#mySidebar').hide();
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

Echo.private("newpost-channel").listen("NewPostEvent", (event) => {

    if (event.user_id == authid) {
        document.getElementById("newNotification").style.display = "inline-block";
        document.getElementById("newNotification").innerHTML = event.count;
    }


});
</script>
@yield('scripts')
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
    padding: 16px
}
</style>
@yield('styles')

</head>


<body>
    <!-- Side Navigation -->
    <nav class="w3-sidebar w3-bar-block w3-collapse w3-white w3-animate-left w3-card" style="z-index:3;width:300px;"
        id="mySidebar">
        @guest


        <a href="" class="w3-bar-item w3-button w3-padding"><i class="fa fa-map fa-fw"></i> Top
            Pages</a>
        <a href="" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cc-discover fa-fw"></i> Discover</a>
        <a href="{{ route('category.index') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list fa-fw"></i> See Categories</a>
        @else
        <div class="w3-container w3-padding w3-margin-top">
            <div class="d-flex w3-padding-top">
                <div>
                @if(Auth::user()->profile->picture === 'avatar.png')
                <img src="/images/avatar.png"
                        class="w3-circle w3-margin-right w3-border" style="width:30px; height:30px;">
                @else
                    <img src="/images/{{ Auth::user()->id }}/profile_pic/{{ Auth::user()->profile->picture }}"
                        class="w3-circle w3-margin-right w3-border" style="width:30px; height:30px;">
                        @endif
                </div>
                <div class="flex-grow-1">
                    <a href="{{ route('profile.show', Auth::user()->username) }}"> {{ Auth::user()->name }} </a>
                </div>
            </div>
        </div>
        <div class="w3-container">
            <button id="edit-profile" edit_profile="{{ route('profile.edit', [Auth::user()->username, Auth::user()->id]) }}"
                onclick="location.href=this.getAttribute('edit_profile')" style="font-size: 12px;"
                class="w3-button">Edit Profile</button>


            <a href="javascript:void(0)" class="w3-button w3-dark-grey w3-button w3-hover-black w3-left-align"
                onclick="document.getElementById('id01').style.display='block'">
                <span class="glyphicon glyphicon-search"></span><sean>
            </a>

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
        <a href="{{ route('write.create') }}" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-pencil fa-fw"></i> Write</a>
        <!-- <a class="w3-bar-item w3-button w3-padding" href="/chatify"> <i class="fa fas fa-envelope"></i> message</a> -->
        <a href="{{ route('shortie-create') }}" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-pencil fa-fw"></i> Shortie</a>
        <a href="{{ route('draft.index') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-pencil fa-fw"></i>
            Drafts</a>
        <!-- <a href="{{ route('photos.index', Auth::user()->username) }}" class="w3-bar-item w3-button w3-padding"><i class="fa fas fa-image"></i> My Photos</a> -->

        <a href="{{ route('history.index', Auth::user()->username) }}" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-history fa-fw"></i> History</a>
        <a href="{{ route('queue.index') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list fa-fw"></i>
            Queued Posts</a>
        <a href="{{ route('category.index') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list fa-fw"></i> See Categories</a>
        <!-- <a href="{{ route('quizzes', $user->username) }}" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-list fa-fw"></i> My Quizzes</a> -->
        <a href="{{ route('profile.show', Auth::user()->username) }}" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-user fa-fw"></i> Profile</a><br><br>
        <br><br>
        

        @endauth
    </nav>


    <!-- Overlay effect when opening the side navigation on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer"
        title="Close Sidemenu" id="myOverlay"></div>

    <main>
        <div id="app">
            <!-- Modal that pops up when you click on "New Message" -->
            <div id="id01" class="w3-modal" style="z-index:4">
                <div class="w3-modal-content w3-animate-zoom">
                    <div class="w3-container w3-padding w3-red">
                        <span id="closeSearchModal" onclick="document.getElementById('id01').style.display='none'"
                            class="w3-button w3-red w3-right w3-xxlarge"><i class="fa fa-remove"></i></span>
                        <h2>Search for authors</h2>
                    </div>
                    <div class="w3-panel">
                        <search-component></search-component>
                        <div class="w3-section">
                            <a class="w3-button w3-red"
                                onclick="document.getElementById('id01').style.display='none'">Cancel <i
                                    class="fa fa-remove"></i></a>
                            <a class="w3-button w3-light-grey w3-right"
                                onclick="document.getElementById('id01').style.display='none'">Send <i
                                    class="fa fa-paper-plane"></i></a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Page content -->
            <div class="w3-main" style="margin-left:320px;">
                <div class="w3-container">
                    <i class="fa fa-bars w3-button w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top"
                        onclick="w3_open()"></i>
                    <a href="javascript:void(0)"
                        class="w3-hide-large w3-red w3-button w3-right w3-margin-top w3-margin-right"
                        onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-search"></i></a>

                    <!-- Drop down on small screen -->
                    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right w3-margin-top "
                        href="javascript:void(0)" onclick="dropmenu_small()" title="Toggle Navigation Menu"><i
                            class="fa fa-bars"></i></a>
                </div>

                <div class="w3-hide-small">
                    <div class="w3-bar w3-black w3-card">
                        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right"
                            href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i
                                class="fa fa-bars"></i></a>

<!-- Maybe a top menu here -->
                            
                    </div>
                </div>



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


    

    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }

    function myFunc(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className += " w3-red";
        } else {
            x.className = x.className.replace(" w3-show", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace(" w3-red", "");
        }
    }

    
    </script>

    

<script src="{{ asset('js/summernote-bs4.js') }}" defer></script>
</body>

</html>
<script src="{{ asset('js/app.js') }}"></script>
<!-- <script src="{{ asset('js/summernote-bs4.js') }}" defer></script> -->
<script src="{{ asset('js/smallScreenOverlay.js') }}" defer></script>


<script>
// $(document).ready(function() {
//     $('#summernote').summernote({
//         height: 400,
//         // toolbar: []
//     })
    
// });

// $(document).ready(function() {
//     $('.summernote').summernote({
//         height: 150
//     });
// });

$(document).keydown(function(event) {
    if (event.keyCode == 27) {
        // $('#modal01').hide();
        $('.w3-modal').hide();
        // $('#mySidebar').hide();
        $('#navDemo').hide();
        // $('#shortieModal').hide();

        $("#closeMenu").click();
        // $("#quotedShortieImages").remove();

    }

    // $("#closeSearchModal").click(function() {
    //     $("#searchAuthor").val("");
    //     $("#searchAuthorDropdown").hide();
    // });

    
});



// Echo.private("group-channel").listen("GroupEvent", (event) => {
      
    //   document.getElementById("grp").innerHTML = "new";
    //   alert(event.groupId)

    //   console.log("...received event");
//   });


</script>
@yield('scripts')
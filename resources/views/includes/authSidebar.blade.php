<nav class="w3-sidebar w3-bar-block w3-collapse w3-text-white w3-animate-left w3-card "
    style="z-index:3;width:300px; background-color: #212121" id="mySidebar"><br>
    <div class="w3-container w3-row">
        <div class="w3-col s4">
            @if(Auth::user()->profile->picture === 'avatar.png')
            <img src="/images/avatar.png" class="w3-circle w3-margin-right" style="width:46px">
            @else
            <img src="/images/{{ Auth::user()->id }}/profile_pic/{{ Auth::user()->profile->picture }}"
                class="w3-circle w3-margin-right" style="width:46px">
            @endif
        </div>
        <div class="w3-col s8 w3-bar">
            <span> <strong><a class="w3-text-white" href="{{ route('profile.show', Auth::user()->username) }}">
                        {{ Auth::user()->name }} </a></strong></span><br>
            <div class="d-flex">
                <a href="{{ route('profile.edit', [Auth::user()->username, Auth::user()->id]) }}"
                    class="w3-bar-item w3-button">Edit</a>
                <a href="javascript:void()" onclick="openSearch()" class="w3-bar-item w3-button"><i
                        class="fa fa-search"></i></a>

            </div>
        </div>
    </div>
    <hr>
    <div class="w3-container">
        <!-- <h5>Dashboard</h5> -->
    </div>
    <div class="w3-bar-block">
        <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black"
            onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i> Close Menu</a>
        <div class="w3-container w3-center">
            <a style="width: 100%; border: 1px solid #212121; background-color: #212121;" href="{{ route('home') }}"
                class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links ">
                Home</a>
        </div>

        <!-- <a href="{{ route('chat.with', Auth::user()->username) }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home fa-fw"></i> Messages -->
        </a>


        <div class="w3-container w3-center">
            <a style="width: 100%; border: 1px solid #212121; background-color: #212121;" href="{{ route('write.index') }}"
                class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links ">
                Write</a>
        </div>

        <div class="w3-container w3-center">
            <a style="width: 100%; border: 1px solid #212121; background-color: #212121;" href="{{ route('draft.index') }}"
                class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links ">
                Drafts</a>
        </div>
        <div class="w3-container w3-center">
            <a style="width: 100%; border: 1px solid #212121; background-color: #212121;"
                href="{{ route('photos.index', Auth::user()->username) }}"
                class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links ">
                Photos</a>
        </div>
        <div class="w3-container w3-center">
            <a style="width: 100%; border: 1px solid #212121; background-color: #212121;" href="{{ route('popular') }}"
                class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links "> Popular on
                Typesicle</a>
        </div>
        
        <div class="w3-container w3-center">
            <a style="width: 100%; border: 1px solid #212121; background-color: #212121;"
                href="{{ route('history.index', Auth::user()->username) }}"
                class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links ">History</a>
        </div>
        <div class="w3-container w3-center">
            <a style="width: 100%; border: 1px solid #212121; background-color: #212121;" href="{{ route('queue.index') }}"
                class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links ">
                Queued Posts</a>
        </div>
        <div class="w3-container w3-center">
            <a style="width: 100%; border: 1px solid #212121; background-color: #212121;" href="{{ route('category.index') }}"
                class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links "> Categories</a>
        </div>
        <!-- <a href="{{ route('quizzes', $user->username) }}" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-list fa-fw"></i> My Quizzes</a> -->
        <div class="w3-container w3-center">
            <a style="width: 100%; border: 1px solid #212121; background-color: #212121;"
                href="{{ route('profile.show', Auth::user()->username) }}"
                class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links ">
                Profile</a>
        </div>
        <br><br>
        <br><br>

    </div>
    <div class="w3-container w3-center">
        <a style="width: 100%;" class="menu-links btn btn-default btn-lg w3-border w3-text-white" href="" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>
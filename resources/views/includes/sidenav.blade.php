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



<div class="w3-container content">
    <div class="w3-row">
        <div class="w3-col m8">


            <!-- Post search -->
            <div class="w3-container w3-margin w3-padding">
                <postsearch-component></postsearch-component>
            </div>


            <!-- Profile -->


            <!-- <h1 class="w3-center" id="loader" style="font-size: 60px;">...</h1> -->
            <div id="profile-main">


                @if (count($user->feeds) == 0)

                @else
                @if($feeds)
                <div style="margin-top: 50px;">


                    <feed-component posts="{{ json_encode($feeds) }}" user-id="{{ $user->id }}"
                        user="{{ json_encode($user) }}" user-type="guest">
                    </feed-component>


                </div>
                @endif
                @endif

                <div>
                    <div class="w3-container w3-border w3-center">

                    </div>
                </div>

                <!-- Hey -->
            </div>

        </div>

        <div class="w3-col m4 w3-hide-small">

            <!-- <div class="w3-container ">
                <div class=" d-flex" style="margin-bottom: 70px; ">
                    <div class="w3-containerw3-padding w3-center">
                        <a style="font-size: 17px;" href="/register" class="w3-button w3-padding w3-border">Sign up </a>
                    </div>
                    <div style="font-size: 23px; w3-padding" class="px-4">or</div>
                    <div class="w3-containerw3-padding w3-center">
                        <a style="font-size: 17px;" href="/login" class="w3-button w3-padding w3-border">Login </a>
                    </div>
                </div>
            </div> -->

            <div class="w3-container w3-center">

                <profile-component current-user="{{ $user->id }}" user="{{ json_encode($user) }}" usertype="guest">
                </profile-component>
            </div>

            @if(count($user->posts) > 2)
            <div class="w3-container w3-margin-top">
                <userrandompost-component user-id="{{ $user->id }}"></userrandompost-component>
            </div>
            @endif

            <div class="w3-container w3-margin-top">
                <photos-component user="{{ $user }}" photos="{{ json_encode($photos) }}"></photos-component>
            </div>

            <div class="w3-container w3-margin-top">

                <recentposts-component posts="{{ json_encode($recentPosts) }}">
                </recentposts-component>
            </div>

            <div class="w3-container w3-margin-top">
                <accounts-component accounts="{{ json_encode($accounts) }}" status="-1">
                </accounts-component>
            </div>

        </div>

    </div>
    <!-- End Middle Column -->
</div>
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



                @if($feeds)
                <div style="margin-top: 50px;">
                    
                    
                    <feed-component posts="{{ json_encode($addToGroup) }}" user-id="{{ Auth::user()->id }}" user="{{ json_encode($user) }}" 
                        user-type="auth">
                    </feed-component>

                    
                    </div>                    
                    @endif


                <div>
                    <div class="w3-container w3-border w3-center">
                        
                    </div>
                </div>

                <!-- End -->
            </div>
        </div>

        <div class="w3-col m4 w3-hide-small">

            <div class="w3-container w3-center">

                <profile-component current-user="{{ $user->id }}" user-id="{{ Auth::user()->id }}" usertype="auth"
                    user="{{ json_encode($user) }}" status="{{Auth::user()->isFollowing($user->profile->id) ? 1 : 0}}">
                </profile-component>
            </div>

            

            <div class="w3-container w3-margin-top">
            <photos-component user="{{ $user }}" photos="{{ json_encode($photos) }}"></photos-component>
            </div>

            @if(count($user->posts) > 2)
            <div class="w3-container w3-margin-top">
                <userrandompost-component user-id="{{ $user->id }}"></userrandompost-component>
            </div>
            @endif
            
            <div class="w3-container w3-margin-top">

                <recentposts-component posts="{{ json_encode($recentPosts) }}">
                </recentposts-component>
            </div>

            <div class="w3-container w3-margin-top">
                <accounts-component accounts="{{ json_encode($accounts) }}"
                    status="{{Auth::user()->isFollowing($user->profile->id) ? 1 : 0}}">
                </accounts-component>
            </div>
        </div>

    </div>
    <!-- End Middle Column -->
</div>
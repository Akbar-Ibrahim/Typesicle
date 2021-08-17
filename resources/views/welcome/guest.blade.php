<div class="w3-container content">
    @include('includes.about')
    <div class="w3-row">
        <div class="w3-col m12">


            <!-- Post search -->
            <div class="w3-container w3-margin w3-padding">
                <postsearch-component></postsearch-component>
            </div>


            <!-- Profile -->

            <div id="profile-main">
                @if($feeds)
                <div style="margin-top: 50px;">

                    <feed-component posts="{{ json_encode($feeds) }}" user-id="{{ $user->id }}"
                        user="{{ json_encode($user) }}" user-type="guest" page="welcome">
                    </feed-component>


                </div>
                @endif
            </div>




        </div>
        <!-- End Middle Column -->
    </div>
</div>
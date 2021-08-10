<div class="w3-container content">
    <div class="w3-row">
        <div class="w3-col m12">


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
                        user-type="auth" page="welcome">
                    </feed-component>

                    
                    </div>                    
                    @endif


                <div>
                    <div class="w3-container w3-center">
                        
                    </div>
                </div>

                <!-- End -->
            </div>
        </div>

        

    </div>
    <!-- End Middle Column -->
</div>
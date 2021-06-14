@extends('layouts.home')

@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">
<style>
.one-image img:hover,
.w3-third img:hover,
.w3-half img:hover,
.w3-quarter img:hover {
    opacity: 0.6;
    transition: 0.3s
}
</style>
@endsection

@section('content')

<div class="w3-main" style="margin-top:43px;">


    <!-- Header -->

    <div class="w3-row-padding w3-margin-bottom">

    </div>



    <div class="w3-container mt-4 py-4">
        <div class="w3-row-padding w3-margin-bottom">
            <div class="w3-col m8">

                <div class="w3-container">
                    <h4>
                        Posts under <a href="{{'/hashtag/'.$hashtag}}"> {{ '#' . $hashtag }} </a> </h4>

                </div>


                
                
                <f-component posts="{{ json_encode($hashtagPosts[0]->feed) }}" user-id="{{ Auth::user()->id }}" user="{{ json_encode($user) }}" 
                user-type="auth">
                    </f-component>

                    

            
            
        </div>

        <div class="w3-col m4">
            <div class="w3-container ">



                <!-- End right -->
            </div>
        </div>

    </div>

</div>

</div>

<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" style="padding-top: 0; z-index: 7;" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
        <img id="img01" class="w3-image" style="width: 50%">
        <p id="caption"></p>

    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/profiles.js') }}" defer></script>

<script>
$(document).ready(function() {

});
</script>
<!--     
    <script>
    
    function openTab(evt, tabName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("tabs");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " w3-red";
    }
    </script> -->

@endsection
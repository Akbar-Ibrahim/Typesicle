@extends('layouts.home')

@section('styles')

<style>
#nodrafts {
    max-width: 700px;
    margin: auto;
    
}
</style>

@endsection

@section('content')
@include('includes.urls')

@if(count($drafts) > 0)
<div class="w3-main" style="margin-top:43px;">


    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
        <!-- <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5> -->
        <h5><b><i class="fa fa-pencil fa-fw"></i> Drafts </b></h5>
    </header>


    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-col l8">

            @foreach($drafts as $draft)
            <div class="w3-container w3-padding w3-margin">
                <div class="w3-col s10">
                    <div route="{{ route('draft.show', $draft->id) }}" style="cursor: pointer" class="w3-hide-small"
                        onclick="location.href=this.getAttribute('route')">
                        <h1> {{ $draft->title ?? 'Untitled' }} </h1>
                    </div>

                    <div route="{{ route('draft.show', $draft->id) }}" style="cursor: pointer" class="w3-hide-large"
                        onclick="location.href=this.getAttribute('route')">
                        <h5> {{ $draft->title ?? 'Untitled' }} </h5>
                    </div>

                    <div class="w3-container">
                        <a href="{{ route('draft.edit', $draft->id) }}">Continue writing</a>
                    </div>
                </div>

                @if($draft->photo)
                <div class="w3-col s2">
                    <img src="{{ '/images/' . $draft->photo->user_id . '/'. $draft->photo->photo }}"
                        onclick="showImage(this)" class="w3-hide-small"
                        style="height: 100px; width: 100%; object-fit: cover; cursor: pointer;">
                    <img src="{{ '/images/' . $draft->photo->user_id . '/'. $draft->photo->photo }}"
                        onclick="showImage(this)" class="w3-hide-large"
                        style="height: 60px; width: 100%; object-fit: cover; cursor: pointer;">
                </div>
                @endif
            </div>
            <hr>
            @endforeach


        </div>

        <div class="w3-col l3">

        </div>


    </div>




</div>

@else
<div class="w3-container " id="nodrafts">
    <div class="w3-center">
        <h2 style="font-size: 50px;">No Drafts</h2>
        <a class="w3-button w3-border" style="font-size: 21px;" href="{{ route('write.create') }}">Start Writing</a>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $(".sendToDraft").click(function() {
        $(this).parents(".menu").next().css("display", "block");
    });

    $(".closeDraftOverlay").click(function() {
        $(this).parents(".sendDraftOverlay").css("display", "none")
    });
});

// function sendDraftOverlay(element) {

//   document.getElementById("sendDraftOverlay").style.display = "block";

// }


function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
            x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

$(document).ready(function() {
    $('.comment-accordion').click(function() {

        $(this).next().toggle();


    });
});


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



// function draftActivityTab(evt, activityName) {
//     document.getElementsByClassName("activityTablink")[0].click();
//     var i, x, tablinks;
//     x = document.getElementsByClassName("activityTab");
//     for (i = 0; i < x.length; i++) {
//         x[i].style.display = "none";
//     }
//     tablinks = document.getElementsByClassName("activityTablink");
//     for (i = 0; i < x.length; i++) {
//         tablinks[i].classList.remove("w3-light-grey");
//     }
//     document.getElementById(activityName).style.display = "block";
//     evt.currentTarget.classList.add("w3-light-grey");
// }

$(document).ready(function() {
    $('.tab1').click(function() {
        $(this).parent().siblings(".at1").css("display", "block");
        $(this).parent().siblings(".at2, .at3").css("display", "none");
    });
});

$(document).ready(function() {
    $('.tab2').click(function() {
        $(this).parent().siblings(".at2").css("display", "block");
        $(this).parent().siblings(".at1, .at3").css("display", "none");
    });
});


$(document).ready(function() {
    $('.tab3').click(function() {
        $(this).parent().siblings(".at3").css("display", "block");
        $(this).parent().siblings(".at1, .at2").css("display", "none");
    });
});
</script>


<script src="{{ asset('js/send-draft.js') }}" defer></script>

@endsection
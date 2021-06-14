@extends('layouts.home')

@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">
<style>
a {
    text-decoration: none;
}

div.scrollmenu {
    background-color: #333;
    overflow: auto;
    white-space: nowrap;
}

div.scrollmenu button {
    display: inline-block;
    color: white;
    text-align: center;
    text-decoration: none;
}

.w3-col img:hover,
.w3-third img:hover {
    opacity: 0.6;
    transition: 0.3s
}
</style>

@endsection

@section('content')
@include('includes.imageModal')


<div class="w3-container">
    <div class="w3-row-padding">
        <div class="w3-col m12">
            <!-- Profile -->

            <!-- photos -->

            <div class="w3-container my-4">
                <h3>Photos</h3>
            </div>

            @if(count($photos) > 0)
            <div class="w3-container">
                <div class="w3-row">
                    @foreach($photos as $photo)
                    <div class="w3-col s3 w3-hide-small">

                        <div class="w3-display-container">
                        <div class="w3-display-topleft w3-black w3-padding"> {{ $photo->created_at->toFormattedDateString() }} </div>
                            <img src="{{ '/images/' . $photo->user_id . '/'. $photo->photo }}" onclick="showImage(this)"
                                style="height: 250px; width: 100%; object-fit: cover; cursor: pointer;">
                        </div>
                    </div>

                    <div class="w3-col s4 w3-hide-large">

                        <div class="w3-display-container">
                            <img src="{{ '/images/' . $photo->user_id . '/'. $photo->photo }}" onclick="showImage(this)"
                                style="height: 150px; width: 100%; object-fit: cover; cursor: pointer;">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="w3-container my-4">
                <div class="w3-center"> {{ $user->name }} does not have any photos</div>
            </div>
            @endif

            @include('includes.imageModal')


        </div>



    </div>
    <!-- End Middle Column -->
</div>




@endsection

@section('scripts')

<script src="{{ asset('js/profiles.js') }}" defer></script>
<script>
    // Modal Image Gallery
function showImage(element) {
    document.getElementById("img01").src = element.src;
    document.getElementById("modal01").style.display = "block";
      var captionText = document.getElementById("caption");
    //   captionText.innerHTML = element.alt;
    captionText.innerHTML = element.getAttribute('description');
}


</script>

@endsection
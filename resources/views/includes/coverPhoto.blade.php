
<!-- Modal for full size images on click -->
<div id="photosOverlay" class="w3-modal w3-black" style="padding-top: 0; z-index: 7;">
    <div class="d-flex">
    <div class="flex-grow-1">
    </div>
    <div onclick="document.getElementById('photosOverlay').style.display='none'" style="font-size: 25px; cursor: pointer;"
        class="w3-button w3-black w3-xlarge "> &times;</div>
        </div>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">


    <div class="w3-container my-2 pb-4">
            <div class="w3-row-padding mb-4" style="height: 500px; overflow: scroll">
                @foreach($photos as $photo)
                <div class="w3-col s3">
                    <img class="photo" file="{{ '/images/'.Auth::user()->id.'/' . $photo->photo }}"
                        src="{{'/images/'.Auth::user()->id.'/' . $photo->photo}}" alt=""
                        style="width: 100%; height: 200px; object-fit: cover; cursor: pointer">
                </div>
                @endforeach
            </div>
        </div>

        
        <div class="w3-container w3-right">
        <button onclick="document.getElementById('photosOverlay').style.display='none'" 
        class="w3-button"> Select </button>
        </div>


    </div>
</div>

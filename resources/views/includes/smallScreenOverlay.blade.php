<div id="photoOverlay" class="w3-modal w3-black" style="padding-top: 0; z-index: 7;">
    <div class="d-flex">
        <div class="flex-grow-1">
        </div>
        <div onclick="document.getElementById('photoOverlay').style.display='none'"
            style="font-size: 25px; cursor: pointer;" class="w3-button w3-black w3-xlarge "> &times;</div>
    </div>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
        <header>
            <h3>Photos</h3>
        </header>

        @foreach($user->photos as $photo)
        <div class="w3-col s3 w3-hide-small">

            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding"> {{ $photo->created_at->toFormattedDateString() }}
                </div>
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

<!-- Modal for full size images on click -->
<div id="categoryOverlay" class="w3-modal w3-black" style="padding-top: 0; z-index: 7;">
    <div class="d-flex">
        <div class="flex-grow-1">
        </div>
        <div onclick="document.getElementById('categoryOverlay').style.display='none'"
            style="font-size: 25px; cursor: pointer;" class="w3-button w3-black w3-xlarge "> &times;</div>
    </div>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
        @foreach($user->categories as $category)
        <div class="w3-row-padding">
            <div class="w3-col s9">
                <a href="{{ route('category-name', [$user->username, $category->url]) }}" class="w3-bar-item w3-button">
                    {{ $category->name }} </a>
            </div>
            <div class="w3-col s3">
                <a href="" class="w3-bar-item w3-button"> {{ count($category->posts) }} </a>
            </div>
        </div>
        @endforeach
    </div>
</div>



<!-- Modal for full size images on click-->
<div id="postOverlay" class="w3-modal w3-black" style="padding-top: 0; z-index: 7;" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
        <div class="">
            <a href="#" class="w3-bar-item w3-button">All</a>
        </div>
        <div class="">
            <a href="{{ route('shorties', [$user->username]) }}" class="w3-bar-item w3-button">Shorties</a>
        </div>
        <div class="">
            <a href="#" class="w3-bar-item w3-button">Reposts</a>
        </div>
        <div class="">
            <a href="{{ route('published-replies', $user->username) }}" class="w3-bar-item w3-button">Published
                Replies</a>
        </div>
    </div>
</div>






















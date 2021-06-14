<div class="w3-container w3-margin">
    @can('update-post', $feed->post)
    <div class="w3-left">
        <button route="{{ route('write.edit', $feed->post->id) }}"
            onclick="location.href=this.getAttribute('route')">Edit</button>
    </div>
    @endcan

    <div class="w3-left">
        <form method="GET" action="/response">
            <input type="hidden" name="responding_to" value="{{ $feed->post->id }}">
            <button> response </button>
        </form>
    </div>

    <div class="w3-left">
        <button onclick="actOnFeed(event);" data-feed-id="{{ $feed->id }}">Like</button>
        <span id="likes-count-{{ $feed->id }}">{{ $feed->likes }}</span>
    </div>

    @can('can-queue', $feed->post)
    <div class="w3-left">
        @if(!Auth::user()->isQueued($feed->id))
        <button class="addToQueue w3-theme-d1 " feed_id="{{ $feed->id }}">
            <i class="fa fa-plus"></i>
            <span> Add to Queue</span> </button>

        @else
        <button class="queued w3-theme-d1 ">
            <i class="fa fa-list"></i>
            <span> Queued </span> </button>
        @endif
    </div>
    @endcan
</div>
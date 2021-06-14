@if(!Auth::user()->isQueued($feed_id))
    <button class="addToQueue w3-theme-d1 " feed_id="{{ $feed_id }}"> 
    <i class="fa fa-plus"></i>
    <span> Add to Queue</span> </button>

@else
<button class="queued w3-theme-d1 "> 
<i class="fa fa-list"></i>
<span> Queued </span> </button>
@endif

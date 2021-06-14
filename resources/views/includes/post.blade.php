
<div style="margin-top: 50px;">
    @foreach($feeds as $feed)

    @if($feed->post)
    @if($feed->post->is_published == "yes")
    <div style="margin-top: 50px;">
        <header-component user="{{ json_encode($feed->user) }}" date="{{ $feed->created_at->toFormattedDateString() }}"
            size="width: 35px">
        </header-component>
        @if($feed->post->responding_to > 0)
        <div class="pl-4"> Responding to <a href="">
                {{ $feed->post->respondingTo($feed->post->responding_to)->title }} </a> by <a href="">
                {{ $feed->post->respondingTo($feed->post->responding_to)->user->name }} </a> </div>
        @endif

        <post-component feed-Id="{{ $feed->id}}" user-id="{{ Auth::user()->id }}" post="{{ json_encode($feed) }}">

            <template v-slot:action>
                @include('includes.feedActions')
            </template>
        </post-component>






    </div>
    @endif
    @endif
    @endforeach
    </div>

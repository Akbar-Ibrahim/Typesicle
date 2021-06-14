@foreach($recentShorties as $feed)
<div class="w3-border" style="margin-top: 50px;">

    @if($feed)
    <div class="w3-border" >

        <header-component 
            user="{{ json_encode($feed->shortie->user) }}" name="{{ $feed->shortie->user->name }}"
            date="{{ $feed->created_at->toFormattedDateString() }}" size="width: 35px">
        </header-component>

        <shortie-component shortie-id="{{ $feed->shortie_id }}" user-id="{{ Auth::user()->id }}"
            shortie="{{ json_encode($feed->shortie) }}"
            route="{{ route('shortie.url', [$feed->user->username, $feed->id])  }}"
            height="{{ count($feed->shortie->shortiePhoto) == 1 ? '250px' : '100px' }}">
            {!! $feed->shortie->shortie !!}
        </shortie-component>

        @if($feed->shortie->quoted > 0)
        <div class="mb-4 w3-margin-top w3-border" style="width: 80%; margin: auto;">
            <header-component 
                user="{{ json_encode($feed->shortie->quotedShortie->user) }}"
                date="{{ $feed->shortie->quotedShortie->created_at->toFormattedDateString() }}"
                size="width: 25px" fontsize="font-size: 11px;">
            </header-component>

            <shortie-component shortie-id="{{ $feed->shortie->quotedShortie->id }}"
                route="{{ route('shortie.url', [$feed->shortie->quotedShortie->user->username, $feed->shortie->quotedShortie->feed->id]) }}"
                user-id="{{ $feed->shortie->quotedShortie->user->id }}"
                shortie="{{ json_encode($feed->shortie->quotedShortie) }}"
                height="{{ count($feed->shortie->quotedShortie->shortiePhoto) == 1 ? '200px' : '80px' }}">
                {!! $feed->shortie->quotedShortie->shortie !!}
            </shortie-component>
        </div>
        @endif
    </div>
    @endif
</div>
@endforeach